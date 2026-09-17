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
    <div class="footer scroll_animation_fade" id="footer" style="--i: 0;">
        <div class="col">
            <a href="<?= site_url ?>gallery.php">Gallery</a>
            <a href="<?= site_url ?>team.php">Meet our team</a>
            <a href="<?= site_url ?>ema4kids_scholars.php">Our scholarship recipients</a>
            <a href="" onclick="alert('URL unavailable')">Privacy Policy</a>
            <a href="" onclick="alert('URL unavailable')">Terms & conditions</a>
            <a href="<?= site_url ?>partner.php">Ema4kids partners</a>
        </div>
        <div class="col">
            <h3>Contact us @</h3>
            <a href="mailto:ema4kids@gmail.com">ema4kids@gmail.com</a>
        </div>
        <div class="col">
            <h3>Follow us @</h3>
            <div class="socials">
                <a target="_blank" href="https://www.facebook.com/share/14rBucJsE7Z/"><ion-icon name="logo-facebook"></ion-icon></a>
                <a target="_blank" href="https://www.instagram.com/ema4kids_?utm_source=ig_web_button_share_sheet&igsi=ZDNlZDc0MzIxNw=="><ion-icon name="logo-instagram"></ion-icon></a>
                <a target="_blank" href="https://www.threads.com/@ema4kids_"><ion-icon name="logo-threads"></ion-icon></a>
            </div>
        </div>
        <div class="col">
            Ema4kids Legacy Foundation is a 501(c)(3) non-profit in the United States operating internationally. 
            Registered in the United States. EIN: 92-2485192<br>Public Charity Status: 170(b)(1)(A)(vi)
        </div>
    </div>
    <div class="copywrite">
        Copyright <?= date("Y"); ?> Ema4kids Legacy Foundation. All Rights Reserved
    </div>
    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.js"></script>
    <script src="<?= site_url ?>javascript/script.js"></script>
</body>
</html>