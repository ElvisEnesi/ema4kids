<?php
    // include files
    require_once '../configuration/database.php';
    require_once '../encryption/encryption.php';
    // declare variables
    $sr_email = $_POST['sr_email'];
    // get uuid from url
    if (isset($_GET['uuid'])) {
        $gotten_uuid = filter_var($_GET['uuid'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    } else {
        header("Location: " . site_url . "user/profile.php");
        exit();
    }
    // check if form is submitted
    if (isset($_POST['sr_details'])) {
        // check if there's empty fields
        if (!$sr_email) {
            $_SESSION['edit_email_sr'] = "Fill in the field!";
        } elseif (!filter_var($sr_email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['edit_email_sr'] = "Invalid email address!";
        } else {
            // 2. Extract the domain name from the email
            $email_parts = explode('@', $sr_email);
            $domain = array_pop($email_parts);

            // 3. Verify if the domain has valid MX (Mail Exchanger) records
            if (!checkdnsrr($domain, 'MX')) {
                $_SESSION['edit_email_sr'] = "Email domain does not exist or cannot receive emails!";
            }
            // encrypt email
            $new_encrypted_email = encrypt($sr_email);
        }
        // redirect if there's any error
        if (isset($_SESSION['edit_email_sr'])) {
            header("Location: " . site_url . "user/profile.php");
            exit();
        } else {
            // update image in database
            $update = mysqli_prepare($conn, "UPDATE sr_tbl SET sr_encrypted_email = ? WHERE sr_uuid = ?");
            // bind parameters
            mysqli_stmt_bind_param($update, "ss", $new_encrypted_email, $gotten_uuid);
            // execute
            mysqli_stmt_execute($update);
            // check if executed
            if (mysqli_stmt_affected_rows($update) > 0) {
                // insert into activity
                $insert_activity = mysqli_prepare($conn, "INSERT INTO activity_log (uuid, activity) VALUES (?,?)");
                // declare activity
                $activity = "Edited your email";
                mysqli_stmt_bind_param($insert_activity, "ss", $_SESSION['uuid'], $activity);
                mysqli_stmt_execute($insert_activity);
                mysqli_stmt_close($insert_activity);
                // redirect with success message
                $_SESSION['reset_success'] = "Email successfully changed!";
                header("location: " . site_url . "user/profile.php");
                exit();
            } else {
                // redirect with error message
                $_SESSION['reset'] = "Couldn't change email, try again!";
                header("location: " . site_url . "user/profile.php");
                exit();
            }
        }
    } else {
        header("Location: " . site_url . "user/profile.php");
        exit();
    }