<?php
    // include files
    require_once './configuration/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipent</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url ?>css/style.css">
</head>
<body>
    <div class="header">
        <div class="logo">Ema4kids</div>
        <div class="nav">
            <div id="side" class="hide"><ion-icon name="close-outline"></ion-icon></div>
            <a href="<?= site_url ?>index.php">Home</a>
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
    <div class="blog_space">
        <h2>Elvis Jatto</h2>
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