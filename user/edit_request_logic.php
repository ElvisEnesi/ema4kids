<?php
    // include files
    require_once '../configuration/database.php';
    // check if submit button was clicked
    if (isset($_POST['edit_request'])) {
        // get uuid from url
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        } else {
            header("Location: " . site_url . "user/requests.php");
            exit();
        }
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
            $_SESSION['edit_request'] = "Fill all inputs";
        } elseif (!is_numeric($total)) {
            $_SESSION['edit_request'] = "Total must be numbers only";
        } elseif ($total < 1) {
            $_SESSION['edit_request'] = "Total cannot be negative";
        } else {
            if ($date_object && $date_object->format($expected_format) === $date_of_request) {
                // Format it safely for your database update
                $sanitized_date = $date_object->format('Y-m-d');
            } else {
                // the input was either a malicious string, gibberish, or an impossible date
                $_SESSION['edit_request'] = "Invalid date format provided!";
            }
        }
        // redirect if there's any error
        if (isset($_SESSION['edit_request'])) {
            header("location: " . site_url . "user/edit_request.php");
            exit();
        } else {
            // round total incase a float was added
            $total = (int) ceil($total);
            // update request into database
            $update = mysqli_prepare($conn, "UPDATE request_tbl SET description=?, date_needed=?, currency=?, total=? WHERE id = ?");
            // bind parameters
            mysqli_stmt_bind_param($update, "sssii", $description, $sanitized_date, $currency, $total, $id);
            // execute statement
            mysqli_stmt_execute($update);
            // check if there was any sql effect
            if (mysqli_stmt_affected_rows($update) > 0) {
                // redirect with success message
                $_SESSION['edit_request_success'] = "Request successfully edited";
                header("location: " . site_url . "user/requests.php");
                exit();
            } else {
                // redirect with error message
                $_SESSION['edit_request'] = "Couldn't make the request";
                header("location: " . site_url . "user/requests.php");
                exit();
            }
            // free & close results
            mysqli_stmt_free_result($update);
            mysqli_stmt_close($update);
        }
    } else {
        header("location: " . site_url . "user/edit_request.php");
        exit();
    }
    