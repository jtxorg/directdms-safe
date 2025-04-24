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

session_start();
include('odm-load.php');

if (!isset($_SESSION['temp_uid']) || !isset($_SESSION['2fa_token'])) {
    header('Location: index.php');
    exit;
}

$last_message = (isset($_REQUEST['last_message']) ? $_REQUEST['last_message'] : '');

if (isset($_POST['verify'])) {
    $token = trim($_POST['token']);
    
    // Verify the token
    $query = "SELECT id FROM {$GLOBALS['CONFIG']['db_prefix']}2fa_tokens 
              WHERE user_id = :user_id 
              AND token = :token 
              AND used = 0 
              AND expires_at > NOW()";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(
        ':user_id' => $_SESSION['temp_uid'],
        ':token' => $token
    ));
    
    if ($stmt->rowCount() > 0) {
        // Mark token as used
        $query = "UPDATE {$GLOBALS['CONFIG']['db_prefix']}2fa_tokens 
                  SET used = 1 
                  WHERE user_id = :user_id 
                  AND token = :token";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':user_id' => $_SESSION['temp_uid'],
            ':token' => $token
        ));
        
        // Set the actual user session
        $_SESSION['uid'] = $_SESSION['temp_uid'];
        unset($_SESSION['temp_uid']);
        unset($_SESSION['2fa_token']);
        unset($_SESSION['2fa_email_error']);
        
        // Run the plugin API
        callPluginMethod('onAfterLogin');
        
        // Redirect to main page
        if (isset($_REQUEST['redirection'])) {
            redirect_visitor($_REQUEST['redirection']);
        } else {
            redirect_visitor('out.php');
        }
    } else {
        $last_message = msg('message_invalid_2fa_token');
    }
} elseif (isset($_POST['continue']) && isset($_SESSION['2fa_email_error'])) {
    // Handle continue without 2FA
    $_SESSION['uid'] = $_SESSION['temp_uid'];
    unset($_SESSION['temp_uid']);
    unset($_SESSION['2fa_token']);
    unset($_SESSION['2fa_email_error']);
    
    // Run the plugin API
    callPluginMethod('onAfterLogin');
    
    // Redirect to main page
    if (isset($_REQUEST['redirection'])) {
        redirect_visitor($_REQUEST['redirection']);
    } else {
        redirect_visitor('out.php');
    }
}

draw_header(msg('label_2fa_verification'), $last_message);

// Display SMTP error if present
if (isset($_SESSION['2fa_email_error'])) {
    echo '<div class="error">' . $_SESSION['2fa_email_error'] . '</div>';
}
?>

<form action="verify_2fa.php" method="post">
    <table border="0" cellspacing="5" cellpadding="5">
        <tr>
            <td><?php echo msg('label_2fa_token'); ?></td>
            <td><input type="text" name="token" size="6" maxlength="6" <?php echo !isset($_SESSION['2fa_email_error']) ? 'required' : ''; ?>></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <div class="buttons">
                    <button class="positive" type="submit" name="verify" value="Verify"><?php echo msg('label_verify'); ?></button>
                    <?php if (isset($_SESSION['2fa_email_error'])): ?>
                        <button class="positive" type="submit" name="continue" value="Continue"><?php echo msg('label_continue_without_2fa'); ?></button>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
    </table>
</form>

<?php
draw_footer();
?> 