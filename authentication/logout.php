<?php
    // include files
    require_once '../configuration/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Out</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url ?>css/style.css"/>
</head>
<body>
    <div class="navigator">
        <h2>Leaving Ema4kids</h2>
        <div class="navigator_card">
            <div class="navigator_links">
                <span>Are you sure you want to logout?</span>
                <ion-icon name="exit-outline"></ion-icon>
                <button onclick="window.location.href='<?= site_url ?>authentication/logout_logic.php'">Yes</button>
            </div>
            <div class="navigator_links">
                <span>Changed your mind?</span>
                <ion-icon name="home-outline"></ion-icon>
                <button onclick="window.location.href='<?= site_url ?>index.php'">Home</button>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.js"></script>
</body>
</html>