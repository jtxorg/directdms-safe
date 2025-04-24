<?php
/*
 * Copyright (C) 2000-2021. Stephen Lawrence
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

// Main login form

session_start();

/*
 * Test to see if we have the config.php file. If not, must not be installed yet.
*/

if (!file_exists('config.php') && !file_exists('docker-configs/config.php')) {
    if (
        !extension_loaded('pdo')
        || !extension_loaded('pdo_mysql')
    ) {
        echo "<p>PHP pdo Extensions not loaded. <a href='./'>try again</a>.</p>";
        exit;
    }
    // A config file doesn't exist
    ?>
    <html>
    <head>
        <link rel="stylesheet" href="templates/common/css/install.css" type="text/css"/>
    </head>
        <body>
            <h2>Looks like this is a new installation because we did not find a config.php file or we cannot locate the
            database. We need to create a config.php file now:</h2>
            <p><a href="install/setup-config.php" class="button">Create a Configuration File</a></p>
        </body>
    </html>
    <?php
    exit;
}

require_once('odm-load.php');
require_once('include/User_class.php');
require_once('include/PHPMailer/PHPMailer.php');
require_once('include/PHPMailer/SMTP.php');
require_once('include/PHPMailer/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use ODM\User;

if (!isset($_REQUEST['last_message'])) {
    $_REQUEST['last_message'] = '';
}

// Call the plugin API
callPluginMethod('onBeforeLogin');

if (isset($_SESSION['uid'])) {
    // redirect to main page
    if (isset($_REQUEST['redirection'])) {
        redirect_visitor($_REQUEST['redirection']);
    } else {
        redirect_visitor('out.php');
    }
}

if (isset($_POST['login'])) {
    if (!is_dir($GLOBALS['CONFIG']['dataDir']) || !is_writable($GLOBALS['CONFIG']['dataDir'])) {
        echo "<font color=red>" . msg('message_datadir_problem') . "</font>";
    }

    $frmuser = $_POST['frmuser'];
    $frmpass = $_POST['frmpass'];

    // check login and md5()
    // connect and execute query
    $query = "
      SELECT
        id,
        username,
        password
      FROM
        {$GLOBALS['CONFIG']['db_prefix']}user
      WHERE
        username = :frmuser
      AND
        password = md5(:frmpass)
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(
        ':frmuser' => $frmuser,
        ':frmpass' => $frmpass
    ));
    $result = $stmt->fetchAll();

    if (count($result) != 1) {
        // Check old password() method
        $query = "
          SELECT
            id,
            username,
            password
          FROM
            {$GLOBALS['CONFIG']['db_prefix']}user
          WHERE
            username = :frmuser
          AND
            password = password(:frmpass)
            ";

        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':frmuser' => $frmuser,
            ':frmpass' => $frmpass
        ));
        $result = $stmt->fetchAll();
    }

    // if row exists - login/pass is correct
    if (count($result) == 1) {
        // register the user's ID
        $id = $result[0]['id'];
        
        // Check if 2FA is enabled
        $query = "SELECT 2fa_enabled FROM {$GLOBALS['CONFIG']['db_prefix']}user WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(':id' => $id));
        $user = $stmt->fetch();
        
        if ($user['2fa_enabled']) {
            // Generate 2FA token
            $token = substr(str_shuffle('0123456789'), 0, 6);
            $expires = date('Y-m-d H:i:s', strtotime('+5 minutes'));
            
            $query = "INSERT INTO {$GLOBALS['CONFIG']['db_prefix']}2fa_tokens (user_id, token, expires_at) 
                     VALUES (:user_id, :token, :expires_at)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':user_id' => $id,
                ':token' => $token,
                ':expires_at' => $expires
            ));
            
            // Get user email
            $query = "SELECT Email FROM {$GLOBALS['CONFIG']['db_prefix']}user WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(':id' => $id));
            $user = $stmt->fetch();
            
            // Get SMTP settings from database
            $query = "SELECT name, value FROM {$GLOBALS['CONFIG']['db_prefix']}settings WHERE name IN ('smtp_host', 'smtp_port', 'smtp_user', 'smtp_password')";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $smtp_settings = array();
            while ($row = $stmt->fetch()) {
                $smtp_settings[$row['name']] = $row['value'];
            }
            
            // Send email with token using SMTP settings
            $mail_body = msg('email_2fa_token_intro') . PHP_EOL . PHP_EOL;
            $mail_body .= msg('email_2fa_token') . ": " . $token . PHP_EOL . PHP_EOL;
            $mail_body .= msg('email_2fa_token_expires') . ": 5 " . msg('email_2fa_token_minutes') . PHP_EOL . PHP_EOL;
            $mail_body .= msg('email_2fa_token_warning') . PHP_EOL . PHP_EOL;
            $mail_body .= msg('email_thank_you') . PHP_EOL;
            
            $email_sent = false;
            if ($GLOBALS['CONFIG']['demo'] == 'False') {
                try {
                    // Create a new PHPMailer instance
                    $mail = new PHPMailer(true);
                    
                    // Server settings
                    $mail->isSMTP();
                    $mail->Host = $smtp_settings['smtp_host'];
                    $mail->SMTPAuth = true;
                    $mail->Username = $smtp_settings['smtp_user'];
                    $mail->Password = $smtp_settings['smtp_password'];
                    
                    // Try different ports and encryption methods
                    $ports = array(587, 465, 25);
                    $encryption = array(
                        587 => PHPMailer::ENCRYPTION_STARTTLS,
                        465 => PHPMailer::ENCRYPTION_SMTPS,
                        25 => PHPMailer::ENCRYPTION_STARTTLS
                    );
                    
                    $last_error = '';
                    foreach ($ports as $port) {
                        try {
                            $mail->Port = $port;
                            $mail->SMTPSecure = $encryption[$port];
                            
                            // Disable SSL verification for development
                            $mail->SMTPOptions = array(
                                'ssl' => array(
                                    'verify_peer' => false,
                                    'verify_peer_name' => false,
                                    'allow_self_signed' => true
                                )
                            );
                            
                            // Set timeout
                            $mail->Timeout = 10;
                            $mail->SMTPKeepAlive = true;
                            
                            // Recipients
                            $mail->setFrom($GLOBALS['CONFIG']['site_mail'], 'Avid Docuworks');
                            $mail->addAddress($user['Email']);
                            
                            // Content
                            $mail->isHTML(false);
                            $mail->Subject = msg('email_2fa_token_subject');
                            $mail->Body = $mail_body;
                            
                            // Set a timeout for the entire operation
                            set_time_limit(30);
                            
                            $email_sent = $mail->send();
                            if ($email_sent) {
                                break; // Success, exit the loop
                            }
                        } catch (Exception $e) {
                            $last_error = $e->getMessage();
                            error_log("Failed to send 2FA email on port {$port}. Error: {$last_error}");
                            continue; // Try next port
                        }
                    }
                    
                    if (!$email_sent) {
                        throw new Exception("Failed to send email on all ports. Last error: {$last_error}");
                    }
                } catch (Exception $e) {
                    error_log("Failed to send 2FA email to " . $user['Email'] . ". SMTP Error: " . $mail->ErrorInfo . 
                             ". Using SMTP settings - Host: " . $smtp_settings['smtp_host'] . 
                             ", Port: " . $smtp_settings['smtp_port'] . 
                             ". Server IP: " . $_SERVER['SERVER_ADDR']);
                    // Store the error message in session for display
                    $_SESSION['2fa_email_error'] = msg('message_2fa_email_failed') . 
                        " (SMTP Error: " . $mail->ErrorInfo . 
                        ". Using SMTP settings - Host: " . $smtp_settings['smtp_host'] . 
                        ", Port: " . $smtp_settings['smtp_port'] . ")";
                }
            }
            
            // Store temporary session data
            $_SESSION['temp_uid'] = $id;
            $_SESSION['2fa_token'] = $token;
            
            // Redirect to 2FA verification page regardless of email status
            if (isset($_REQUEST['redirection'])) {
                header('Location: verify_2fa.php?redirection=' . urlencode($_REQUEST['redirection']));
            } else {
                header('Location: verify_2fa.php');
            }
            exit;
        }
        
        // initiate a session
        $_SESSION['uid'] = $id;

        // Run the plugin API
        callPluginMethod('onAfterLogin');

        // redirect to main page
        if (isset($_REQUEST['redirection'])) {
            redirect_visitor($_REQUEST['redirection']);
        } else {
            redirect_visitor('out.php');
        }
        // close connection
    } else {
        // Login Failed
        // redirect to error page

        // Call the plugin API
        callPluginMethod('onFailedLogin');

        header('Location: error.php?ec=0');
    }
} elseif (!isset($_POST['login']) && $GLOBALS['CONFIG']['authen'] == 'mysql') {
    $redirection = (isset($_REQUEST['redirection']) ? $_REQUEST['redirection'] : '');

    $GLOBALS['smarty']->assign('redirection', htmlentities($redirection, ENT_QUOTES));
    display_smarty_template('login.tpl');
} else {
    echo 'Check your config';
}
draw_footer();
