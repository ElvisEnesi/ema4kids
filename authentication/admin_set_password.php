<?php
    // include files
    require_once '../configuration/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign In to EMA4KIDS</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url ?>css/style.css"/>
</head>
<body>
    <div class="welcome_note">
        <h2>Set new password</h2>
    </div>
    <?php if (isset($_SESSION['reset'])) : ?>
        <div class="error">
            <?php echo $_SESSION['reset']; ?>
        </div>
    <?php endif; ?>
    <?php unset($_SESSION['reset']); ?>
    <div class="form">
        <form action="<?= site_url ?>authentication/admin_set_password_logic.php" method="post">
            <div class="form-group">
                <label for="create_password">Create Password</label>
                <input type="password" id="create_password"  name="create_password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password">
            </div>
            <button type="submit" name="admin_set">Set password</button>
        </form>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.js"></script>
    <script src="<?= site_url ?>javascript/script.js"></script>
</body>
</html>