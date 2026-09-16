<?php
    // include files
    require_once '../configuration/database.php';
    // check if submit button was clicked
    if (isset($_POST['request'])) {
        // declare variables
        $description = (string) $_POST['description'];
        $currency = (string) $_POST['currency'];
        $total = (int) $_POST['total'];
        $date_of_request = trim($_POST['date_of_request']);
        // expected date format
        $expected_format = 'Y-m-d';
        // parse the date using PHP's DateTime object
        $date_object = DateTime::createFromFormat($expected_format, $date_of_request);
        // validate inputs
        if (!$description || !$currency || !$total || !$date_of_request) {
            $_SESSION['add_request'] = "Fill all inputs";
        } elseif (!is_numeric($total)) {
            $_SESSION['add_request'] = "Total must be numbers only";
        } elseif ($total < 1) {
            $_SESSION['add_request'] = "Total cannot be negative";
        } else {
            if ($date_object && $date_object->format($expected_format) === $date_of_request) {
                // Format it safely for your database insertion
                $sanitized_date = $date_object->format('Y-m-d');
            } else {
                // the input was either a malicious string, gibberish, or an impossible date
                $_SESSION['add_request'] = "Invalid date format provided!";
            }
            // get user's details from session uuid
            $select = mysqli_prepare($conn, "SELECT sr_uuid, sr_firstname, sr_lastname, sr_middlename, sr_encrypted_email FROM sr_tbl
            WHERE sr_uuid = ? LIMIT 1");
            mysqli_stmt_bind_param($select, "s", $_SESSION['uuid']);
            // execute statement
            mysqli_stmt_execute($select);
            $result = mysqli_stmt_get_result($select);
            if (mysqli_num_rows($result) > 0) {
                $details = mysqli_fetch_assoc($result);
                // define middlename since it might pass null values
                $middlename = $details['sr_middlename'] ?? null;
            } else {
                $_SESSION['add_request'] = "You do not exist in database";
            }
            // free & close results
            mysqli_stmt_free_result($select);
            mysqli_stmt_close($select);
        }
        // redirect if there's any error
        if (isset($_SESSION['add_request'])) {
            header("location: " . site_url . "user/add_request.php");
            exit();
        } else {
            // round total incase a float was added
            $total = (int) ceil($total);
            // insert request into database
            $insert = mysqli_prepare($conn, "INSERT INTO request_tbl (firstname, lastname, middlename, encrypted_email,
            description, date_needed, currency, total, user_uuid) VALUES (?,?,?,?,?,?,?,?,?)");
            // bind parameters
            mysqli_stmt_bind_param($insert, "sssssssis", $details['sr_firstname'], $details['sr_lastname'],
            $middlename, $details['sr_encrypted_email'], $description, $sanitized_date, $currency, $total, $_SESSION['uuid']);
            // execute statement
            mysqli_stmt_execute($insert);
            // check if there was any sql effect
            if (mysqli_stmt_affected_rows($insert) > 0) {
                // redirect with success message
                $_SESSION['add_request_success'] = "Request successfully made";
                header("location: " . site_url . "user/requests.php");
                exit();
            } else {
                // redirect with error message
                $_SESSION['add_request'] = "Couldn't make the request";
                header("location: " . site_url . "user/requests.php");
                exit();
            }
            // free & close results
            mysqli_stmt_free_result($insert);
            mysqli_stmt_close($insert);
        }
    } else {
        header("location: " . site_url . "user/add_request.php");
        exit();
    }
    