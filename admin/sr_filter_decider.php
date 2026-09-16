<?php
    // include files
    require_once '../configuration/database.php';
    // check if submit button was clicked
    if (isset($_POST['all'])) {
        // redirect to sr page
        header("location: ". site_url . "admin/sr.php");
        exit();
    } elseif (isset($_POST['active'])) {
        // redirect to active sr page
        header("location: ". site_url . "admin/sr_filter.php?filter=active");
        exit();
    } elseif (isset($_POST['graduated'])) {
        // redirect to graduated sr page
        header("location: ". site_url . "admin/sr_filter.php?filter=graduated");
        exit();
    } else {
        die("role not set");
    }
    