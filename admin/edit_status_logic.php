<?php
    // include files
    require_once '../configuration/database.php';
    // check if submit button was clicked
    if (isset($_POST['edit_status'])) {
        // get uuid from url
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        } else {
            header("Location: " . site_url . "admin/requests.php");
            exit();
        }
        // declare variables
        $status = (string) $_POST['status'];
        // validate inputs
        if (!$status) {
            $_SESSION['edit_status'] = "Fill all inputs";
        }
        // redirect if there's any error
        if (isset($_SESSION['edit_status'])) {
            header("location: " . site_url . "admin/edit_status.php");
            exit();
        } else {
            // update request into database
            $update = mysqli_prepare($conn, "UPDATE request_tbl SET status=? WHERE id = ?");
            // bind parameters
            mysqli_stmt_bind_param($update, "si", $status, $id);
            // execute statement
            mysqli_stmt_execute($update);
            // check if there was any sql effect
            if (mysqli_stmt_affected_rows($update) > 0) {
                // insert into activity
                $insert_activity = mysqli_prepare($conn, "INSERT INTO activity_log (uuid, activity) VALUES (?,?)");
                // declare activity
                $activity = "Edited request status to " . $status . " for " . $id;
                mysqli_stmt_bind_param($insert_activity, "ss", $_SESSION['uuid'], $activity);
                mysqli_stmt_execute($insert_activity);
                mysqli_stmt_close($insert_activity);
                // redirect with success message
                $_SESSION['edit_status_success'] = "Status successfully edited";
                header("location: " . site_url . "admin/requests.php");
                exit();
            } else {
                // redirect with error message
                $_SESSION['edit_status'] = "Couldn't edit status";
                header("location: " . site_url . "admin/requests.php");
                exit();
            }
            // free & close results
            mysqli_stmt_free_result($update);
            mysqli_stmt_close($update);
        }
    } else {
        header("location: " . site_url . "admin/edit_status.php");
        exit();
    }
    