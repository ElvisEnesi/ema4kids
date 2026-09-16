<?php
    // include files
    include "../configuration/database.php";
    // check if the submit button was clicked
    if (isset($_POST['admin_reset'])) {
        // declare variables
        $admin_email = filter_var($_POST['admin_email'], FILTER_SANITIZE_EMAIL);
        // validate inputs
        if (!$admin_email) {
            $_SESSION['admin_reset'] = "Fill in all inputs";
        } elseif (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['admin_reset'] = "Invalid email address!";
        } else {
            // Extract the domain name from the email
            $email_parts = explode('@', $admin_email);
            $domain = array_pop($email_parts);
            // Verify if the domain has valid MX (Mail Exchanger) records
            if (!checkdnsrr($domain, 'MX')) {
                $_SESSION['admin_reset'] = "Email domain does not exist or cannot receive emails!";
            }
            // hash admin email for search
            $admin_hashed_email = hash("sha256", $admin_email);
            // search database for details
            $admin_search = mysqli_prepare($conn, "SELECT hashed_email FROM admin_tbl WHERE hashed_email = ? LIMIT 1");
            // bind parameters
            mysqli_stmt_bind_param($admin_search, "s", $admin_hashed_email);
            // execute statement
            mysqli_stmt_execute($admin_search);
            // get results
            $admin_result = mysqli_stmt_get_result($admin_search);
            // check if available
            if (mysqli_num_rows($admin_result) > 0) {
                // convert details to an associate array
                $admin_details = mysqli_fetch_assoc($admin_result);
                // verify email
                if ($admin_details['hashed_email'] == $admin_hashed_email) {
                    // set hased email in session
                    $_SESSION['hased_email_to_change'] = $admin_hashed_email;
                    // redirect to reset page
                    header("location: " . site_url . "authentication/admin_set_password.php");
                    exit();
                }
            } else {
                $_SESSION['admin_reset'] = "User not found";
            }   
        }
        // redirect if there's any error
        if (isset($_SESSION['admin_reset'])) {
            header("location: " . site_url . "authentication/admin_reset_password.php");
            exit();
        }
    } else {
        header("location: " . site_url . "authentication/signin_navigate.php");
        exit();
    }
    