<?php
    // include files
    require_once '../configuration/database.php';
    // check if submit button was clicked
    if (isset($_POST['all'])) {
        // redirect to requests page
        header("location: ". site_url . "user/requests.php");
        exit();
    } elseif (isset($_POST['approved'])) {
        // redirect to approved requests page
        header("location: ". site_url . "user/requests_filter.php?filter=approved");
        exit();
    } elseif (isset($_POST['pending'])) {
        // redirect to pending requests page
        header("location: ". site_url . "user/requests_filter.php?filter=pending");
        exit();
    } elseif (isset($_POST['correct'])) {
        // redirect to correct requests page
        header("location: ". site_url . "user/requests_filter.php?filter=correct");
        exit();
    } else {
        die("role not set");
    }
    