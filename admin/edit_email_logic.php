<?php
    // include files
    require_once '../configuration/database.php';
    require_once '../encryption/encryption.php';
    // declare variables
    $admin_email = $_POST['admin_email'];
    // get uuid from url
    if (isset($_GET['uuid'])) {
        $gotten_uuid = filter_var($_GET['uuid'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    } else {
        header("Location: " . site_url . "admin/profile.php");
        exit();
    }
    // check if form is submitted
    if (isset($_POST['admin_details'])) {
        // check if there's empty fields
        if (!$admin_email) {
            $_SESSION['edit_email_admin'] = "Fill in the field!";
        } elseif (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['edit_email_admin'] = "Invalid email address!";
        } else {
            // Extract the domain name from the email
            $email_parts = explode('@', $admin_email);
            $domain = array_pop($email_parts);
            // Verify if the domain has valid MX (Mail Exchanger) records
            if (!checkdnsrr($domain, 'MX')) {
                $_SESSION['edit_email_admin'] = "Email domain does not exist or cannot receive emails!";
            }
            // encrypt email
            $new_encrypted_email = encrypt($admin_email);
        }
        // redirect if there's any error
        if (isset($_SESSION['edit_email_admin'])) {
            header("Location: " . site_url . "admin/profile.php");
            exit();
        } else {
            // update image in database
            $update = mysqli_prepare($conn, "UPDATE admin_tbl SET encrypted_email = ? WHERE uuid = ?");
            // bind parameters
            mysqli_stmt_bind_param($update, "ss", $new_encrypted_email, $gotten_uuid);
            // execute
            mysqli_stmt_execute($update);
            // check if executed
            if (mysqli_stmt_affected_rows($update) > 0) {
                // redirect with success message
                $_SESSION['reset_success'] = "Email successfully changed!";
                header("location: " . site_url . "admin/profile.php");
                exit();
            } else {
                // redirect with error message
                $_SESSION['reset'] = "Couldn't change email, try again!";
                header("location: " . site_url . "admin/profile.php");
                exit();
            }
        }
    } else {
        header("Location: " . site_url . "admin/profile.php");
        exit();
    }