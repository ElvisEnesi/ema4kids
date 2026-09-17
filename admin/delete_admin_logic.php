<?php
    // include files
    require_once '../configuration/database.php';
    // get uuid from url
    if (isset($_GET['uuid'])) {
        $uuid = (string) $_GET['uuid'];
        // get admin first using uuid from url
        $select = mysqli_prepare($conn, "SELECT uuid, firstname FROM admin_tbl WHERE uuid = ? LIMIT 1");
        // bind parameters
        mysqli_stmt_bind_param($select, "s", $uuid);
        mysqli_stmt_execute($select);
        $result = mysqli_fetch_assoc(mysqli_stmt_get_result($select));
        $firstname = $result['firstname'];
    } else {
        // redirect to delete admin page
        header("location: " . site_url . "admin/delete_admin.php");
        exit();
    }
    if (isset($_POST['delete_admin'])) {
        // delete admin
        $delete = mysqli_prepare($conn, "DELETE FROM admin_tbl WHERE uuid = ? LIMIT 1");
        // bind parameters
        mysqli_stmt_bind_param($delete, "s", $uuid);
        mysqli_stmt_execute($delete);
        if (mysqli_stmt_affected_rows($delete) > 0) {
            // insert into activity
            $insert_activity = mysqli_prepare($conn, "INSERT INTO activity_log (uuid, activity) VALUES (?,?)");
            // declare activity
            $activity = "Delete admin " . $firstname;
            mysqli_stmt_bind_param($insert_activity, "ss", $_SESSION['uuid'], $activity);
            mysqli_stmt_execute($insert_activity);
            mysqli_stmt_close($insert_activity);
            // redirect with message
            $_SESSION['delete_admin_success'] = "Admin successfully deleted!!";
            header("location: " . site_url . "admin/admins.php");
            exit();
        } else {
            $_SESSION['delete_admin'] = "Unable to delete admin";
            header("location: " . site_url . "admin/admins.php");
            exit();
        }
    } else {
        header("location: " . site_url . "admin/delete_admin.php");
        exit();
    }
    
