<?php
    // include files
    require_once '../configuration/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Blog Post</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url ?>css/style.css">
</head>
<body>
    <div class="header">
        <div class="logo">Ema4kids</div>
        <div class="nav">
            <a href="<?= site_url ?>index.php">Home</a>
            <a href="<?= site_url ?>blog/blog.php">Blog</a>
            <a href="<?= site_url ?>authentication/signin_navigate.php">sign in</a>
        </div>
        <div id="side" class="show"><ion-icon name="menu-outline"></ion-icon></div>
        <div id="side" class="hide"><ion-icon name="close-outline"></ion-icon></div>
    </div>
    <div class="blog_space">
        <h2>Our latest story</h2>
        <div class="blog_date">30<sup>th</sup> August, 2026</div>
        <div class="small_highlight">
            <div class="author_detail">
                <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47 (2).jpeg" alt="" class="author_image">
                <div class="author_for_this">Elvis Jatto</div>
            </div>
            <div class="share_post">
                <ion-icon name="copy-outline"></ion-icon> Copy address
            </div>
        </div>
        <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47 (1).jpeg" alt="" class="blog_img">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque enim obcaecati illum natus inventore iste 
            nobis quia quibusdam, ea temporibus vel repellat, odio deserunt repellendus reprehenderit voluptates error sint 
            neque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo voluptate inventore quas expedita quod 
            adipisci ex accusantium, aperiam velit sapiente molestias iure quam animi incidunt eligendi modi labore dolorum 
            nemo. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint aut qui ut asperiores in deleniti ea, et 
            omnis labore minima officiis, dicta aliquid provident voluptatem repellendus magni veniam! Velit, suscipit!
        </p>
        <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47 (1).jpeg" alt="" class="blog_img">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque enim obcaecati illum natus inventore iste 
            nobis quia quibusdam, ea temporibus vel repellat, odio deserunt repellendus reprehenderit voluptates error sint 
            neque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo voluptate inventore quas expedita quod 
            adipisci ex accusantium, aperiam velit sapiente molestias iure quam animi incidunt eligendi modi labore dolorum 
            nemo. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint aut qui ut asperiores in deleniti ea, et 
            omnis labore minima officiis, dicta aliquid provident voluptatem repellendus magni veniam! Velit, suscipit!
        </p>
        <img src="<?= site_url ?>images/WhatsApp Image 2026-04-08 at 15.43.47 (1).jpeg" alt="" class="blog_img">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque enim obcaecati illum natus inventore iste 
            nobis quia quibusdam, ea temporibus vel repellat, odio deserunt repellendus reprehenderit voluptates error sint 
            neque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo voluptate inventore quas expedita quod 
            adipisci ex accusantium, aperiam velit sapiente molestias iure quam animi incidunt eligendi modi labore dolorum 
            nemo. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint aut qui ut asperiores in deleniti ea, et 
            omnis labore minima officiis, dicta aliquid provident voluptatem repellendus magni veniam! Velit, suscipit!
        </p>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.js"></script>
    <script src="<?= site_url ?>javascript/script.js"></script>
</body>
</html>