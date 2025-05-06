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

// Copyright (C) 2005-2006 Glowball Solutions
// Utility to reset a user password



include_once('odm-load.php');
require_once('Email_class.php');
require_once('include/PHPMailer/PHPMailer.php');
require_once('include/PHPMailer/SMTP.php');
require_once('include/PHPMailer/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Aura\Html\Escaper as e;


if (isset($GLOBALS['CONFIG']['allow_password_reset']) && $GLOBALS['CONFIG']['allow_password_reset'] != 'True') {
    echo msg('message_sorry_not_allowed');
    exit;
}

if (!isset($_REQUEST['last_message'])) {
    $_REQUEST['last_message']='';
}

if (
    isset($_POST['password'])
    && strlen($_POST['password'])
    && isset($_POST['username'])
    && strlen($_POST['username'])
    && isset($_POST['code'])
    && (strlen($_POST['code']) == 32)
    && isset($_POST['user_id'])
    && $_POST['user_id'] + 0 > 0
) {
    // reset their password and code
    $newPass = trim($_POST['password']);
    $oldCode = str_replace(' ', '', $_POST['code']);
    $username = str_replace(' ', '', $_POST['username']);
    $user_id = (int) $_POST['user_id']+0;

    // reset the password
    $query = "
      UPDATE
        {$GLOBALS['CONFIG']['db_prefix']}user
      SET
        password = md5(:new_pass),
        pw_reset_code = NULL
      WHERE
        id = :user_id
      AND
        username = :username
      AND
        pw_reset_code = :old_code
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(
        ':new_pass' => $newPass,
        ':user_id' => $user_id,
        ':username' => $username,
        ':old_code' => $oldCode
    ));

    $redirect = 'index.php?last_message=' . urlencode(msg('message_your_password_has_been_changed'));
    header("Location: $redirect");
    exit;
} elseif (
    isset($_GET['username'])
    && strlen($_GET['username'])
    && isset($_GET['code'])
    && (strlen($_GET['code']) == 32)
) {
    // they have clicked on the link we sent them
    $username = trim($_GET['username']);
    $code = trim($_GET['code']);

    // make sure we have a match
    $query = "
      SELECT
        id
      FROM
        {$GLOBALS['CONFIG']['db_prefix']}user
      WHERE
        username = :username
      AND
        pw_reset_code = :code
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(
        ':username' => $username,
        ':code' => $code
    ));

    if ($stmt->rowCount() < 1) {
        $redirect = 'forgot_password.php?last_message=' . urlencode(msg('message_the_code_you_are_using'));
        header("Location: $redirect");
        exit;
    } else {
        $userInfo = $stmt->fetch();
        $user_id = $userInfo['id'];
        // build the header and navigation
        /*





           ADD FORMATTING HERE




         */
	$last_message = (isset($_REQUEST['last_message']) ? $_REQUEST['last_message'] : '');
        draw_header(msg('forgot_password'), $last_message);
        ?>

            <p><?php echo msg('message_set_your_new_password')?></p>

            <form action="forgot_password.php" method="post">
            <input type="hidden" name="action" value="forgot">
            <input type="hidden" name="user_id" value="<?php echo e::h($user_id);
        ?>">
            <input type="hidden" name="username" value="<?php echo e::h($username);
        ?>">
            <input type="hidden" name="code" value="<?php echo e::h($code);
        ?>">
            <table>
            <tr>
            <th><?php echo msg('label_new_password')?>:</th>
            <td><input type="password" name="password" size="12" maxlength="50"></td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td><input type="submit" value="Reset Password"></td>
            </tr>
            </table>
            </form>

            <?php
	draw_footer();
            // build the footer
            /*





               ADD FORMATTING HERE




             */
    }
} elseif (isset($_POST['username']) && strlen($_POST['username']) > 0) {
    // they have sent an username
    $username = trim($_POST['username']);

    // find them in the database
    $query = "
      SELECT
        id,
        Email
      FROM
        {$GLOBALS['CONFIG']['db_prefix']}user
      WHERE
        username = :username
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':username' => $username));

    // send them back if we didn't find the username
    if ($stmt->rowCount() == 0) {
        $redirect = 'forgot_password.php?last_message=' . urlencode(msg('message_the_username_you_entered'));
        header("Location: $redirect");
        exit;
    } else {
        $user_info = $stmt->fetch();
        $user_id = $user_info['id'];
        $email = $user_info['Email'];

        // create a reset code
        $salt = "abcdefghjkmnpqrstuvwxyz23456789ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
        $i = 0;
        $randstring = '';
        while ($i <= 7) {
            $num = rand() % 63;
            $tmp = substr($salt, $num, 1);
            $randstring .= $tmp;
            $i++;
        }
        $reset_code = md5($randstring);

        // add the reset code to the database for this user
        $query = "
          UPDATE
            {$GLOBALS['CONFIG']['db_prefix']}user
          SET
            pw_reset_code = :reset_code
          WHERE
            id = :user_id
        ";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':reset_code' => $reset_code,
            ':user_id' => $user_id
        ));

        // generate the link
        $resetLink = $GLOBALS['CONFIG']['base_url'] . '/forgot_password.php?username=' . e::h($username) . '&code=' . e::h($reset_code);
        $mail_headers  = "From: " . $GLOBALS['CONFIG']['site_mail'] . PHP_EOL;
        $mail_headers .= "Content-Type: text/plain; charset=UTF-8" . PHP_EOL;
        $mail_body  = msg('email_someone_has_requested_password').PHP_EOL . PHP_EOL;
        $mail_body .= $resetLink . PHP_EOL . PHP_EOL;
        $mail_body .= msg('email_thank_you') . PHP_EOL . PHP_EOL;
        $mail_body .= msg('area_admin') . PHP_EOL . PHP_EOL;
        
        // send the email
        if ($GLOBALS['CONFIG']['demo'] == 'False') {
                $query = "SELECT name, value FROM {$GLOBALS['CONFIG']['db_prefix']}settings WHERE name IN ('smtp_host', 'smtp_port', 'smtp_user', 'smtp_password')";
                $smtp_stmt = $pdo->prepare($query);
                $smtp_stmt->execute();
                $smtp_settings = array();
                while ($row = $smtp_stmt->fetch()) {
                    $smtp_settings[$row['name']] = $row['value'];
                }


                // Log SMTP settings (without password)
                error_log("SMTP Settings - Host: " . ($smtp_settings['smtp_host'] ?? 'not set') . 
                          ", Port: " . ($smtp_settings['smtp_port'] ?? 'not set') . 
                          ", Username: " . ($smtp_settings['smtp_user'] ?? 'not set'));
                    
                // Check if we have all required SMTP settings
                if (empty($smtp_settings['smtp_host']) || empty($smtp_settings['smtp_user'])) {
                    error_log("Missing SMTP settings for email notification");
                    // Continue without sending email
                } else {
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = $smtp_settings['smtp_host'];
                    $mail->SMTPAuth = true;
                    $mail->Username = $smtp_settings['smtp_user'];
                    $mail->Password = $smtp_settings['smtp_password'];

                    $email_sent = false;
                    $last_error = '';
                    try {
                        $mail->Port = 2525;

                        $mail->SMTPSecure = 2525;
                        // Disable SSL verification for development
                        $mail->SMTPOptions = array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            )
                        );
                        // Clear recipients before retrying
                        $mail->clearAddresses();
                        $mail->setFrom($GLOBALS['CONFIG']['site_mail'], 'Avid Docuworks');
                        $mail->addAddress($email);
                        $mail->isHTML(true);
                        $mail->Subject = msg('area_reset_password');
			$mail->Body = $mail_body;

                        if ($mail->send()) {
                            $email_sent = true;
                            error_log("Notification email sent successfully on port 2525"); //{$port}");
                        }
                    } catch (Exception $e) {
                        $last_error = $e->getMessage();
                        error_log("Failed to send notification email on port 2525 Error: {$last_error}");
                    }
		}
	}
        $redirect = 'forgot_password.php?last_message=' . urlencode(msg('message_an_email_has_been_sent'));
        header("Location: $redirect");
        exit;
    }
}

// default form
else {
	$last_message = (isset($_REQUEST['last_message']) ? $_REQUEST['last_message'] : '');
        draw_header(msg('forgot_password'), $last_message);
    ?>

        <p><?php echo msg('message_this_site_has_high_security')?></p>


        <form action="forgot_password.php" method="post">
        <table border="0">
        <tr>
        <th><?php echo msg('username')?>    :</th>
        <td><input type="text" name="username" size="25" maxlength="25"></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td><input type="submit" value="Reset Password"></td>
        </tr>
        </table>
        </form>

        <?php
	draw_footer();

}
