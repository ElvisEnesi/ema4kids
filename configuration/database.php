<?php
    // set error reporting level
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // start session if session isn't already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // set default url
    define('site_url', 'http://localhost:3000/');
    // set default timezone
    date_default_timezone_set('Africa/Lagos');
    // database configuration
    $dbHost = 'localhost';
    $dbName = 'ema4kids_db';
    $dbUser = 'elvis';
    $dbPass = 'ElvisSecure2026!';
    // create connection
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    // check connection
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        // echo "Connected successfully";
        // echo date('Y-m-d H:i:s') . " - Connected successfully to the database: " . $dbName . "<br>";
    }