<?php
    // include files
    require_once '../configuration/database.php';
    // check if submit button was clicked
    if (isset($_POST['ASC'])) {
        // redirect to sr page
        header("location: ". site_url . "admin/sr_sort.php?sort=ASC");
        exit();
    } elseif (isset($_POST['DESC'])) {
        // redirect to approved sr page
        header("location: ". site_url . "admin/sr_sort.php?sort=DESC");
        exit();
    } else {
        die("role not set");
    }
    