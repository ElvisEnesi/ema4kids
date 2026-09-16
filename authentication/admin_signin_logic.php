<?php
    // include files
    include "../configuration/database.php";
    // check if the submit button was clicked
    if (isset($_POST['admin_signin'])) {
        // declare variables
        $admin_email = filter_var($_POST['admin_email'], FILTER_SANITIZE_EMAIL);
        $admin_key = filter_var($_POST['admin_key'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // validate inputs
        if (!$admin_email || !$admin_key) {
            $_SESSION['admin_signin'] = "Fill in all inputs";
        } elseif (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['admin_signin'] = "Invalid email address!";
        } else {
            // Extract the domain name from the email
            $email_parts = explode('@', $admin_email);
            $domain = array_pop($email_parts);
            // Verify if the domain has valid MX (Mail Exchanger) records
            if (!checkdnsrr($domain, 'MX')) {
                $_SESSION['admin_signin'] = "Email domain does not exist or cannot receive emails!";
            }
            // hash admin email for search
            $admin_hashed_email = hash("sha256", $admin_email);
            // search database for details
            $admin_search = mysqli_prepare($conn, "SELECT * FROM admin_tbl WHERE hashed_email = ? LIMIT 1");
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
                // obtain database password
                $admin_db_key = $admin_details['hashed_password'];
                // verify password
                if (password_verify($admin_key, $admin_db_key)) {
                    $_SESSION['uuid'] = $admin_details['uuid'];
                    if ($admin_details['is_admin'] == 1) {
                        $_SESSION['is_admin'] = true;
                    }
                    // redirect to dashboard
                    header("location: " . site_url . "admin/dashboard.php");
                    exit();
                } else {
                    $_SESSION['admin_signin'] = "Incorrect password";
                }
            } else {
                $_SESSION['admin_signin'] = "User not found";
            }   
        }
        // redirect if there's any error
        if (isset($_SESSION['admin_signin'])) {
            header("location: " . site_url . "authentication/admin_signin.php");
            exit();
        }
    } else {
        header("location: " . site_url . "authentication/signin_navigate.php");
        exit();
    }
    