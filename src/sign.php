<?php
session_start();
include('odm-load.php');

// Include PHPMailer classes
require_once('include/PHPMailer/PHPMailer.php');
require_once('include/PHPMailer/SMTP.php');
require_once('include/PHPMailer/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location:error.php?ec=2');
    exit;
}

$file_id = $_GET['id'];
$file_data_obj = new FileData($file_id, $pdo);

// Check if user has permission to view this file
checkUserPermission($_GET['id'], $file_data_obj->READ_RIGHT, $file_data_obj);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['self_sign'])) {
        // Redirect to signing page
        header("Location: sign_document.php?id=" . $file_id);
        exit;
    } elseif (isset($_POST['send_for_signature'])) {
        // Validate email
        $recipient_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        if (!$recipient_email) {
            $error = "Invalid email address";
        } else {
            try {
                // Generate a unique request key and password
                $request_key = md5(uniqid(rand(), true));
                $password = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);
                
                // Debug notify flag
                $notify_value = isset($_POST['notify']) ? 1 : 0;
                error_log("Notify checkbox value: " . $notify_value . ", raw post value: " . var_export($_POST['notify'] ?? 'not set', true));
                
                // Create signature request
                $stmt = $pdo->prepare("INSERT INTO {$GLOBALS['CONFIG']['db_prefix']}signature_requests 
                    (file_id, requester_id, recipient_email, request_key, status, notify_on_complete, password) 
                    VALUES (:file_id, :requester_id, :recipient_email, :request_key, 'pending', :notify, :password)");
                
                try {
                    $stmt->execute([
                        ':file_id' => $file_id,
                        ':requester_id' => $_SESSION['uid'],
                        ':recipient_email' => $recipient_email,
                        ':request_key' => $request_key,
                        ':notify' => $notify_value,
                        ':password' => $password
                    ]);
                } catch (PDOException $e) {
                    // If password column doesn't exist, fallback to combined key
                    if (strpos($e->getMessage(), "Unknown column 'password'") !== false) {
                        $stmt = $pdo->prepare("INSERT INTO {$GLOBALS['CONFIG']['db_prefix']}signature_requests 
                            (file_id, requester_id, recipient_email, request_key, status, notify_on_complete) 
                            VALUES (:file_id, :requester_id, :recipient_email, :request_key, 'pending', :notify)");
                        
                        $stmt->execute([
                            ':file_id' => $file_id,
                            ':requester_id' => $_SESSION['uid'],
                            ':recipient_email' => $recipient_email,
                            ':request_key' => $request_key . '|' . $password,
                            ':notify' => $notify_value
                        ]);
                    } else {
                        // Re-throw if it's a different error
                        throw $e;
                    }
                }
                
                // Send email to recipient
                // Get SMTP settings from database
                $query = "SELECT name, value FROM {$GLOBALS['CONFIG']['db_prefix']}settings WHERE name IN ('smtp_host', 'smtp_port', 'smtp_user', 'smtp_password')";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $smtp_settings = array();
                while ($row = $stmt->fetch()) {
                    $smtp_settings[$row['name']] = $row['value'];
                }
                
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
                    
                    $email_sent = false;
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
                            $mail->addAddress($recipient_email);
                            
                            // Content
                            $mail->isHTML(true);
                            $mail->Subject = "Document Signature Request: " . $file_data_obj->getName();
                            $mail->Body = "
                                <p>Hello,</p>
                                <p>You have been requested to sign a document.</p>
                                <p>Document: " . $file_data_obj->getName() . "</p>
                                <p><strong>Your Password: {$password}</strong></p>
                                <p>Please click the link below to view and sign the document:</p>
                                <p><a href='" . $GLOBALS['CONFIG']['base_url'] . "sign_document_external.php?key={$request_key}'>Click here to sign document</a></p>
                                <p>This link will expire in 7 days.</p>
                                <p>Best regards,<br>Avid Docuworks</p>
                            ";
                            
                            $email_sent = $mail->send();
                            if ($email_sent) {
                                break; // Success, exit the loop
                            }
                        } catch (Exception $e) {
                            $last_error = $e->getMessage();
                            error_log("Failed to send signature request email on port {$port}. Error: {$last_error}");
                            continue; // Try next port
                        }
                    }
                    
                    if (!$email_sent) {
                        throw new Exception("Failed to send email on all ports. Last error: {$last_error}");
                    }
                    
                    $success = "Signature request has been sent to {$recipient_email}";
                } catch (Exception $e) {
                    $error = "Failed to send signature request: " . $e->getMessage();
                    error_log("Email sending error: " . $e->getMessage());
                }
            } catch (Exception $e) {
                $error = "Failed to create signature request: " . $e->getMessage();
                error_log("Database error: " . $e->getMessage());
            }
        }
    }
}

// Display the page
draw_header("Document Signing", isset($error) ? $error : (isset($success) ? $success : ''));

$GLOBALS['smarty']->assign('file_name', $file_data_obj->getName());

$GLOBALS['smarty']->display('sign.tpl');
draw_footer(); 
