<?php
    // include files
    include "../configuration/database.php";
    // destroy session
    session_unset();
    session_destroy();
    // redirect to home page
    header("location: " . site_url . "index.php");
    exit();