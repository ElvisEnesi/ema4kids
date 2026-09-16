<?php
    // include files
    include "../configuration/database.php";
    // check if the submit button was clicked
    if (isset($_POST['sr_signin'])) {
        // declare variables
        $sr_email = filter_var($_POST['sr_email'], FILTER_SANITIZE_EMAIL);
        $sr_key = filter_var($_POST['sr_key'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // validate inputs
        if (!$sr_email || !$sr_key) {
            $_SESSION['sr_signin'] = "Fill in all inputs";
        } elseif (!filter_var($sr_email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['sr_signin'] = "Invalid email address!";
        } else {
            // Extract the domain name from the email
            $email_parts = explode('@', $sr_email);
            $domain = array_pop($email_parts);
            // Verify if the domain has valid MX (Mail Exchanger) records
            if (!checkdnsrr($domain, 'MX')) {
                $_SESSION['sr_signin'] = "Email domain does not exist or cannot receive emails!";
            }
            // hash sr email for search
            $sr_hashed_email = hash("sha256", $sr_email);
            // search database for details
            $sr_search = mysqli_prepare($conn, "SELECT * FROM sr_tbl WHERE sr_hashed_email = ? LIMIT 1");
            // bind parameters
            mysqli_stmt_bind_param($sr_search, "s", $sr_hashed_email);
            // execute statement
            mysqli_stmt_execute($sr_search);
            // get results
            $sr_result = mysqli_stmt_get_result($sr_search);
            // check if available
            if (mysqli_num_rows($sr_result) > 0) {
                // convert details to an associate array
                $sr_details = mysqli_fetch_assoc($sr_result);
                // obtain database password
                $sr_db_key = $sr_details['hashed_password'];
                // verify password
                if (password_verify($sr_key, $sr_db_key)) {
                    $_SESSION['uuid'] = $sr_details['sr_uuid'];
                    if ($sr_details['is_admin'] == 0) {
                        $_SESSION['is_admin'] = false;
                    }
                    // redirect to dashboard
                    header("location: " . site_url . "user/dashboard.php");
                    exit();
                } else {
                    $_SESSION['sr_signin'] = "Incorrect password";
                }
            } else {
                $_SESSION['sr_signin'] = "User not found";
            }   
        }
        // redirect if there's any error
        if (isset($_SESSION['sr_signin'])) {
            header("location: " . site_url . "authentication/sr_sign_in.php");
            exit();
        }
    } else {
        header("location: " . site_url . "authentication/signin_navigate.php");
        exit();
    }
    