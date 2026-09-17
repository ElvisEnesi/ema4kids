<?php
    // include files
    require_once '../configuration/database.php';
    // get uuid from url
    if (isset($_GET['uuid'])) {
        $uuid = (string) $_GET['uuid'];
    } else {
        // redirect to edit admin page
        header("location: " . site_url . "admin/edit_admin.php");
        exit();
    }
    if (isset($_POST['edit_admin'])) {
        // declare variables
        $firstname = (string) $_POST['firstname'];
        $lastname = (string) $_POST['lastname'];
        $middlename = (string) $_POST['middlename'] ?? null;
        $title = (string) $_POST['title'];
        $rq_role = (int) $_POST['rq_role'] ?? null;
        $rp_role = (int) $_POST['rp_role'] ?? null;
        $bl_role = (int) $_POST['bl_role'] ?? null;

        // validate inputs
        if (!$firstname || !$lastname || !$title) {
            $_SESSION['edit_admin'] = "Fill in all fields!";
        }
        // redirect back to edit admin page if there's any error
        if (isset($_SESSION['edit_admin'])) {
            header("location: " . site_url . "admin/edit_admin.php?uuid=" . $uuid);
            exit();
        } else {
            // update database
            $update = mysqli_prepare($conn, "UPDATE admin_tbl SET firstname = ?, lastname = ?, middlename = ?, 
            title = ?, rq_role = ?, rp_role = ?, bl_role = ? WHERE uuid = ?");
            // bind parameters
            mysqli_stmt_bind_param($update, "ssssiiis", $firstname, $lastname, $middlename, 
            $title, $rq_role, $rp_role, $bl_role, $uuid);
            // execute sql statement
            mysqli_stmt_execute($update);
            if (mysqli_stmt_affected_rows($update) > 0) {
                // insert into activity
                $insert_activity = mysqli_prepare($conn, "INSERT INTO activity_log (uuid, activity) VALUES (?,?)");
                // declare activity
                $activity = "Edited admin " . $firstname;
                mysqli_stmt_bind_param($insert_activity, "ss", $_SESSION['uuid'], $activity);
                mysqli_stmt_execute($insert_activity);
                mysqli_stmt_close($insert_activity);
                // redirect with message
                $_SESSION['edit_admin_success'] = "Admin successfully edited!!";
                header("location: " . site_url . "admin/admins.php");
                exit();
            } else {
                $_SESSION['edit_admin'] = "Unable to edit admin";
                header("location: " . site_url . "admin/admins.php");
                exit();
            }
        }
    } else {
        header("location: " . site_url . "admin/edit_admin.php");
        exit();
    }
    
