<?php
    // include files
    require_once __DIR__ . '/../configuration/database.php';
    require_once __DIR__ . '/../encryption/encryption.php';
    // require_once __DIR__ . '/../security/ip.php';
    require_once __DIR__ . '/../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..', '.venv');
    $dotenv->load();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // get user details
    $user_uuid = $_SESSION['uuid'];
    // get user email
    $get_email = "SELECT encrypted_email FROM admin_tbl WHERE uuid = ?";
    $get_email_stmt = mysqli_prepare($conn, $get_email);
    mysqli_stmt_bind_param($get_email_stmt, "s", $user_uuid);
    mysqli_stmt_execute($get_email_stmt);
    $email_result = mysqli_stmt_get_result($get_email_stmt);
    if (mysqli_num_rows($email_result) > 0) {
        $row = mysqli_fetch_assoc($email_result);
        $user_email = decrypt($row['email']);
    } else {
        // handle error if user not found
        die("User not found.");
    }

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USERNAME'];
        $mail->Password = $_ENV['SMTP_PASSWORD'];
        $mail->SMTPSecure = $_ENV['SMTP_ENCRYPTION'];
        $mail->Port = $_ENV['SMTP_PORT'];

        $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
        $mail->addAddress($user_email);

        $mail->isHTML(true);
        $mail->Subject = 'Login notice';
        $mail->Body = 'Your OTP is Do not share this with anyone.';

        $mail->send();
        // echo "Email sent";

    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }