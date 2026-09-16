<?php
    // include files
    require_once './configuration/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ema4kids Team</title>
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
    <div class="ps-hero">
        <div class="ps-hero-tag">Team sturcture</div>
        <div class="ps-hero-title">Ema4kids Team Members</div>
        <div class="ps-hero-sub">
            Our alumni are living proof that investment in youth changes communities. They have gone on to become positive 
            leaders of change, agents of peace, and exemplars of excellence exactly as they pledged.
        </div>
    </div>
    <div class="note_to_know">
        <strong>Ema4kids Board members:</strong> 
    </div>
    <div class="alumni-grid">
        <div class="alumni-card scroll_animation_fade" style="--i: 0;">
            <div class="alumni-photo">
                <img src="<?= site_url ?>images/board/meshack.jpg" alt="" 
                onclick="window.location.href='<?= site_url ?>team_light_page.php'">
            </div>
            <div class="alumni-info">
                <div class="alumni-name">Dr. Daniel Jatau Meshak</div>
            </div>
        </div>
        <div class="alumni-card scroll_animation_fade" style="--i: 1;">
            <div class="alumni-photo">
                <img src="<?= site_url ?>images/board/chom.jpg" alt="" 
                onclick="window.location.href='<?= site_url ?>team_light_page.php'">
            </div>
            <div class="alumni-info">
                <div class="alumni-name">Mr Chom Bagu</div>
            </div>
        </div>
        <div class="alumni-card scroll_animation_fade" style="--i: 2;">
            <div class="alumni-photo">
                <img src="<?= site_url ?>images/board/mayuai.jpg" alt="" 
                onclick="window.location.href='<?= site_url ?>team_light_page.php'">
            </div>
            <div class="alumni-info">
                <div class="alumni-name">Barrister Kiyenpiya F.M. Mafuyai</div>
            </div>
        </div>
        <div class="alumni-card scroll_animation_fade" style="--i: 3;">
            <div class="alumni-photo">
                <img src="<?= site_url ?>images/board/marti.jpg" alt="" 
                onclick="window.location.href='<?= site_url ?>team_light_page.php'">
            </div>
            <div class="alumni-info">
                <div class="alumni-name">Miss Martina Pugno</div>
            </div>
        </div>
        <div class="alumni-card scroll_animation_fade" style="--i: 4;">
            <div class="alumni-photo">
                <img src="<?= site_url ?>images/board/image.jpg" alt="" 
                onclick="window.location.href='<?= site_url ?>team_light_page.php'">
            </div>
            <div class="alumni-info">
                <div class="alumni-name">Miss Juliana Adar Nyam</div>
            </div>
        </div>
        <div class="alumni-card scroll_animation_fade" style="--i: 5;">
            <div class="alumni-photo">
                <img src="<?= site_url ?>images/board/image.jpg" alt="" 
                onclick="window.location.href='<?= site_url ?>team_light_page.php'">
            </div>
            <div class="alumni-info">
                <div class="alumni-name">Mrs Mariya Shuaibu Suleiman</div>
            </div>
        </div>
    </div>
    <div class="note_to_know">
        <strong>Ema4Kids team:</strong> 
    </div>
    <div class="alumni-grid">
        <div class="alumni-card scroll_animation_fade" style="--i: 0;">
            <div class="alumni-photo">
                <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47 (1).jpeg" alt="" 
                onclick="window.location.href='<?= site_url ?>team_light_page.php'">
            </div>
            <div class="alumni-info">
                <div class="alumni-name">[Alumni Name]</div>
                <div class="alumni-degree">Executive Director</div>
            </div>
        </div>
    </div>
    <div class="footer" id="footer">
        <div class="col">
            <a href="gallery.html">Gallery</a>
            <a href="team.html">Meet our team</a>
            <a href="ema4kids_scholars.html">Our scholarship recipients</a>
            <a href="policy.html">Privacy Policy</a>
            <a href="t&c.html">Terms & conditions</a>
            <a href="partner.html">Ema4kids partners</a>
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
        Copyright 2026 Ema4kids Legacy Foundation. All Rights Reserved
    </div>

    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.js"></script>
    <script src="script.js"></script>
</body>
</html>