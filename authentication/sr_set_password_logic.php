<?php
    // include files
    require_once '../configuration/database.php';
    if (isset($_POST['sr_set'])) {
        // declare variables
        $create_password = filter_var($_POST['create_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // validate inputs
        if (!$create_password || !$confirm_password) {
            $_SESSION['reset'] = "Fill in all fields!";
        } elseif ($create_password !== $confirm_password) {
            $_SESSION['reset'] = "Passwords do not match!";
        } else {
            //hash passwords
            $hashed_password = password_hash($confirm_password, PASSWORD_DEFAULT);
        }
        // redirect back to add authentication page if there's any error
        if (isset($_SESSION['reset'])) {
            header("location: " . site_url . "authentication/sr_set_password.php");
            exit();
        } else {
            // update database password
            $update = mysqli_prepare($conn, "UPDATE sr_tbl SET hashed_password = ? WHERE sr_hashed_email = ?");
            // bind parameters
            mysqli_stmt_bind_param($update, "ss", $hashed_password, $_SESSION['hased_email_to_change']);
            // execute
            mysqli_stmt_execute($update);
            // check if executed
            if (mysqli_stmt_affected_rows($update) > 0) {
                // redirect with success message
                $_SESSION['reset_success'] = "Password successfully changed, login now!";
                header("location: " . site_url . "authentication/sr_sign_in.php");
                exit();
            } else {
                // redirect with error message
                $_SESSION['reset'] = "Couldn't change, try again!";
                header("location: " . site_url . "authentication/sr_sign_in.php");
                exit();
            }
        }
    } else {
        header("location: " . site_url . "authentication/signin_navigate.php");
        exit();
    }
    
