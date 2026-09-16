<?php
    // include files
    require_once '../configuration/database.php';
    // check if submit button was clicked
    if (isset($_POST['ASC'])) {
        // redirect to requests page
        header("location: ". site_url . "user/request_sort.php?sort=ASC");
        exit();
    } elseif (isset($_POST['DESC'])) {
        // redirect to approved requests page
        header("location: ". site_url . "user/request_sort.php?sort=DESC");
        exit();
    } else {
        die("role not set");
    }
    