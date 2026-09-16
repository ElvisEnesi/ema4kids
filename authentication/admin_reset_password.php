<?php
    // include files
    require_once '../configuration/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url ?>css/style.css"/>
</head>
<body>
    <div class="welcome_note">
        <p>Recover your password!</p>
    </div>
    <?php if (isset($_SESSION['admin_reset'])) : ?>
        <div class="error">
            <?php echo $_SESSION['admin_reset']; ?>
        </div>
    <?php endif; ?>
    <?php unset($_SESSION['admin_reset']); ?>
    <div class="form">
        <form action="<?= site_url ?>authentication/admin_reset_password_logic.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="admin_email">
            </div>
            <button type="submit" name="admin_reset">Proceed</button>
        </form>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.js"></script>
    <script src="<?= site_url ?>javascript/script.js"></script>
</body>
</html>