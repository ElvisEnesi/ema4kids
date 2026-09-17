<?php
    // include files
    require_once '../configuration/database.php';
    // get uuid from url
    if (isset($_GET['uuid'])) {
        $uuid = (string) $_GET['uuid'];
    } else {
        // redirect to edit admin page
        header("location: " . site_url . "admin/edit_sr.php");
        exit();
    }
    if (isset($_POST['edit_sr'])) {
        // declare variables
        $firstname = (string) $_POST['firstname'];
        $lastname = (string) $_POST['lastname'];
        $middlename = (string) $_POST['middlename'] ?? null;
        $degree = (string) $_POST['degree'];
        $status = (string) $_POST['status'];
        // validate inputs
        if (!$firstname || !$lastname || !$degree) {
            $_SESSION['edit_sr'] = "Fill in all fields!";
        }
        // redirect back to edit admin page if there's any error
        if (isset($_SESSION['edit_sr'])) {
            header("location: " . site_url . "admin/edit_sr.php?uuid=" . $uuid);
            exit();
        } else {
            // update database
            $update = mysqli_prepare($conn, "UPDATE sr_tbl SET sr_firstname = ?, sr_lastname = ?, sr_middlename = ?, 
            degree = ?, status = ? WHERE sr_uuid = ?");
            // bind parameters
            mysqli_stmt_bind_param($update, "ssssss", $firstname, $lastname, $middlename, $degree, $status, $uuid);
            // execute sql statement
            mysqli_stmt_execute($update);
            if (mysqli_stmt_affected_rows($update) > 0) {
                // insert into activity
                $insert_activity = mysqli_prepare($conn, "INSERT INTO activity_log (uuid, activity) VALUES (?,?)");
                // declare activity
                $activity = "Edited scholarship recipient " . $firstname;
                mysqli_stmt_bind_param($insert_activity, "ss", $_SESSION['uuid'], $activity);
                mysqli_stmt_execute($insert_activity);
                mysqli_stmt_close($insert_activity);
                // redirect with message
                $_SESSION['edit_sr_success'] = "Scholarship Recipient successfully edited!!";
                header("location: " . site_url . "admin/sr.php");
                exit();
            } else {
                $_SESSION['edit_sr'] = "Unable to edit scholarship recipient";
                header("location: " . site_url . "admin/sr.php");
                exit();
            }
        }
    } else {
        header("location: " . site_url . "admin/edit_sr.php");
        exit();
    }
    
