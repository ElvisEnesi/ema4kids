<?php
    // include files
    require_once '../configuration/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Recipient Sign In to EMA4KIDS</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url ?>css/style.css"/>
</head>
<body>
    <div class="welcome_note">
        <h2>Welcome to EMA4KIDS</h2>
        <p>Sign in to get started!</p>
    </div>
    <?php if (isset($_SESSION['sr_signin'])) : ?>
        <div class="error">
            <?php echo $_SESSION['sr_signin']; ?>
        </div>
    <?php endif; ?>
    <?php unset($_SESSION['sr_signin']); ?>
    <?php if (isset($_SESSION['reset_success'])) : ?>
        <div class="success">
            <?php echo $_SESSION['reset_success']; ?>
        </div>
    <?php endif; ?>
    <?php unset($_SESSION['reset_success']); ?>
    <?php if (isset($_SESSION['reset'])) : ?>
        <div class="error">
            <?php echo $_SESSION['reset']; ?>
        </div>
    <?php endif; ?>
    <?php unset($_SESSION['reset']); ?>
    <div class="form">
        <form action="<?= site_url ?>authentication/sr_signin_logic.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="sr_email">
            </div>
            <div class="form-group">
                <label for="key">Password</label>
                <input type="password" id="key" name="sr_key">
            </div>
            <div class="form_group">
                <label for="show_password">Show password</label>
                <input type="checkbox" onclick="showPassword()" id="show_password" name="show_password">
            </div>
            <button type="submit" name="sr_signin">Sign Up</button>
        </form>
        <div class="forgot_password">
            Forgot your password? <a href="<?= site_url ?>authentication/sr_reset_password.php">Click....</a>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.js"></script>
    <script src="<?= site_url ?>javascript/script.js"></script>
</body>
</html>