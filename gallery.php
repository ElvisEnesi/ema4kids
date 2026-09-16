<?php
    // include files
    require_once './configuration/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ema4kids Gallery</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url ?>css/style.css">
</head>
<body>
    <div class="header">
        <div class="logo">Ema4kids</div>
        <div class="nav">
            <div id="side" class="hide"><ion-icon name="close-outline"></ion-icon></div>
            <a href="<?= site_url ?>index.php">Home</a>
            <a href="<?= site_url ?>about.php">About</a>
            <a href="<?= site_url ?>service.php">Our services</a>
            <a href="<?= site_url ?>blog/blog.php">Blog</a>
            <a href="<?= site_url ?>donate.php">Donate</a>
            <a href="mailto:ema4kids@gmail.com">Contact us</a>
            <!--Control login links-->
            <?php if (isset($_SESSION['uuid'])) : ?>
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) : ?>
                    <a href="<?= site_url ?>admin/dashboard.php">Dashboard</a>
                <?php else : ?>
                    <a href="<?= site_url ?>user/dashboard.php">Dashboard</a>
                <?php endif; ?>
            <?php else : ?>
                <a href="<?= site_url ?>authentication/signin_navigate.php">sign in</a>
            <?php endif; ?>
        </div>
        <div id="side" class="show"><ion-icon name="menu-outline"></ion-icon></div>
    </div>
    <div class="slideshow-container">
        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47 (1).jpeg" style="height: 100%; width:100%">
            <div class="text">Caption Text</div>
        </div>
        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47 (2).jpeg" style="height: 100%; width:100%">
            <div class="text">Caption Two</div>
        </div>
        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47.jpeg" style="height: 100%; width:100%">
            <div class="text">Caption Three</div>
        </div>
        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>

    </div>
    <br>
    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span> 
        <span class="dot" onclick="currentSlide(2)"></span> 
        <span class="dot" onclick="currentSlide(3)"></span> 
    </div>
    <!-- Photo Grid -->
    <div class="row"> 
        <div class="column">
            <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47 (1).jpeg" style="width:100%">
            <img src="<?= site_url ?>images/Shirt.jpg" style="width:100%">
            <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47 (2).jpeg" style="width:100%">
            <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47.jpeg" style="width:100%">
        </div>
        <div class="column">
            <img src="<?= site_url ?>images/Shirt.jpg" style="width:100%">
            <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47 (2).jpeg" style="width:100%">
            <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47.jpeg" style="width:100%">
            <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47 (1).jpeg" style="width:100%">
        </div>  
        <div class="column">
            <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47 (1).jpeg" style="width:100%">
            <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47 (2).jpeg" style="width:100%">
            <img src="<?= site_url ?>images/Shirt.jpg" style="width:100%">
            <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47.jpeg" style="width:100%">
        </div>
        <div class="column">
            <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47 (1).jpeg" style="width:100%">
            <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47 (2).jpeg" style="width:100%">
            <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47.jpeg" style="width:100%">
            <img src="<?= site_url ?>images/Shirt.jpg" style="width:100%">
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.js"></script>
    <script src="<?= site_url ?>javascript/script.js"></script>
</body>
</html>