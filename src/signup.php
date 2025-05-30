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

// (C) 2002-2007 Stephen Lawrence Jr., Jon Miner
// Adds files to the repository

require_once('odm-load.php');
require_once('AccessLog_class.php');
require_once('Email_class.php');
require_once('include/PHPMailer/PHPMailer.php');
require_once('include/PHPMailer/SMTP.php');
require_once('include/PHPMailer/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Aura\Html\Escaper as e;

if ($GLOBALS['CONFIG']['allow_signup'] == 'True') {

    // Submitted so insert data now
    if (isset($_REQUEST['adduser'])) {
        // Check to make sure user does not already exist
        $query = "
          SELECT
            username
          FROM
            {$GLOBALS['CONFIG']['db_prefix']}user
          WHERE
            username = :username
        ";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $_POST['username']);
        $stmt->execute();

        // If the above statement returns more than 0 rows, the user exists, so display error
        if ($stmt->rowCount() > 0) {
            echo msg('message_user_exists');
            exit;
        } else {
            $phonenumber = (!empty($_REQUEST['phonenumber']) ? $_REQUEST['phonenumber'] : '');
            // INSERT into user
            $query = "
              INSERT INTO
                {$GLOBALS['CONFIG']['db_prefix']}user
                (
                  username,
                  password,
                  department,
                  phone,
                  Email,
                  last_name,
                  first_name
                ) VALUES (
                  :username,
                  md5(:password),
                  :department,
                  :phonenumber,
                  :email,
                  :last_name,
                  :first_name
                  )";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':username', $_POST['username']);
            $stmt->execute(array(
                ':username' => $_POST['username'],
                ':password' => $_POST['password'],
                ':department' => $_POST['department'],
                ':phonenumber' => $phonenumber,
                ':email' => $_POST['Email'],
                ':last_name' => $_POST['last_name'],
                ':first_name' => $_POST['first_name']
            ));

            // INSERT into admin
            $userid = $pdo->lastInsertId();

            // mail user telling him/her that his/her account has been created.
            echo msg ('message_account_created') . ' ' . $_POST['username'].'<br />';
            if($GLOBALS['CONFIG']['authen'] == 'mysql') {
                //lol noone was sending email!
		// CUT THIS ALL OUT AND PUT IT IN A CLASS!
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
                            $mail->addAddress($_POST['Email']);
                            $mail->isHTML(true);
                            $mail->Subject = "Your account has been created!";
                            $mail->Body = msg('message_account_created_password') . ': '. e::h($_REQUEST['password']) . PHP_EOL . PHP_EOL;
			    $mail->Body .= '<br><a href="' . $GLOBALS['CONFIG']['base_url'] . '">' . msg('login'). '</a>';

                            if ($mail->send()) {
                                $email_sent = true;
                                error_log("Notification email sent successfully on port 2525"); //{$port}");
                            }
                        } catch (Exception $e) {
                            $last_error = $e->getMessage();
                            error_log("Failed to send notification email on port 2525 Error: {$last_error}");
                        }
		}

                echo msg('message_account_created_password') . ': '. e::h($_REQUEST['password']) . PHP_EOL . PHP_EOL;
                echo '<br><a href="' . $GLOBALS['CONFIG']['base_url'] . '">' . msg('login'). '</a>';
                exit;
            }
        }
    }
?>
        <html>
        <head><title>Sign Up</title></head>
        <body>
<?php
    if (is_readable("signup_header.html")) {
        include("signup_header.html");
    }
    ?>
                
            <font size=6>Sign Up</font>
        <br><script type="text/javascript" src="FormCheck.js"></script>


        <table border="0" cellspacing="5" cellpadding="5">
        <form name="add_user" action="signup.php" method="POST" enctype="multipart/form-data">
        <tr><td><b><?php echo msg('label_last_name');
    ?></b></td><td><input name="last_name" type="text"></td></tr>
        <tr><td><b><?php echo msg('label_first_name');
    ?></b></td><td><input name="first_name" type="text"></td></tr>
        <tr><td><b><?php echo msg('username');
    ?></b></td><td><input name="username" type="text"></td></tr>
        <tr>
        <td><b>Phone Number</b></td>
        <td>
        <input name="phonenumber" type="text">
        </td>
        </tr>
        <tr>
        <td><b>Example</b></td>
        <td><b>999 9999999</b></td>
        </tr>
        <tr>
        <td><b>E-mail Address</b></td>
        <td>
        <input name="Email" type="text">
        </td>
        </tr>
        <tr>
        <?php
        // If mysqlauthentication, then ask for password
        if ($GLOBALS['CONFIG']['authen'] =='mysql') {
            $rand_password = makeRandomPassword();
            echo '<INPUT type="hidden" name="password" value="' . $rand_password . '">';
        }
    ?>

        <tr>
        <td><b>Department</b></td>
        <td>
        <select name="department">
        <?php	
        // query to get a list of departments
        $query = "
          SELECT
            id,
            name
          FROM
            {$GLOBALS['CONFIG']['db_prefix']}department
          ORDER BY
            name
        ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach ($result as $row) {
        echo '<option value=' . e::h($row['id']) . '>' . e::h($row['name']) . '</option>';
    }

    ?>
        </select>
        </td>
        <tr>
        <td></td>
        <td columnspan=3 align="center"><input type="Submit" name="adduser" onClick="return validatemod(add_user);" value="<?php echo msg('submit');
    ?>">
        </form>
        </td>
        </tr>
        </table>
<?php
   if (is_readable("signup_footer.html")) {
       include("signup_footer.html");
   }
    ?>

        </body>
        </html>
        <?php

}
