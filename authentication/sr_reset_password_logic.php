<?php
    // include files
    include "../configuration/database.php";
    // check if the submit button was clicked
    if (isset($_POST['sr_reset'])) {
        // declare variables
        $sr_email = filter_var($_POST['sr_email'], FILTER_SANITIZE_EMAIL);
        // validate inputs
        if (!$sr_email) {
            $_SESSION['sr_reset'] = "Fill in all inputs";
        } elseif (!filter_var($sr_email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['sr_reset'] = "Invalid email address!";
        } else {
            // Extract the domain name from the email
            $email_parts = explode('@', $sr_email);
            $domain = array_pop($email_parts);
            // Verify if the domain has valid MX (Mail Exchanger) records
            if (!checkdnsrr($domain, 'MX')) {
                $_SESSION['sr_reset'] = "Email domain does not exist or cannot receive emails!";
            }
            // hash sr email for search
            $sr_hashed_email = hash("sha256", $sr_email);
            // search database for details
            $sr_search = mysqli_prepare($conn, "SELECT sr_hashed_email FROM sr_tbl WHERE sr_hashed_email = ? LIMIT 1");
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
                // verify email
                if ($sr_details['sr_hashed_email'] == $sr_hashed_email) {
                    // set hased email in session
                    $_SESSION['hased_email_to_change'] = $sr_hashed_email;
                    // redirect to reset page
                    header("location: " . site_url . "authentication/sr_set_password.php");
                    exit();
                }
            } else {
                $_SESSION['sr_reset'] = "User not found";
            }   
        }
        // redirect if there's any error
        if (isset($_SESSION['sr_reset'])) {
            header("location: " . site_url . "authentication/sr_reset_password.php");
            exit();
        }
    } else {
        header("location: " . site_url . "authentication/signin_navigate.php");
        exit();
    }
    