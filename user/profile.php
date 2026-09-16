<?php
    // include files
    require_once '../configuration/database.php';
    require_once '../encryption/encryption.php';
    // define logged in user
    $logged_in_user = $_SESSION['uuid'];
    // select user from database
    $user_select = mysqli_prepare($conn, "SELECT * FROM sr_tbl WHERE sr_uuid = ?");
    mysqli_stmt_bind_param($user_select, "s", $logged_in_user);
    mysqli_stmt_execute($user_select);
    $user_result = mysqli_stmt_get_result($user_select);
    $user_data = mysqli_fetch_assoc($user_result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ema4kids Profile</title>
    <link rel="stylesheet" href="<?= site_url ?>css/style.css">
</head>
<body>
    <div class="dashboard_container">
        <aside>
            <div class="apps_close" id="closeDash" onclick="hide_dash()"><ion-icon name="close-outline"></ion-icon></div>
            <div class="aside_header">
                <div class="profile_logo">Ema4kids</div>
                <div class="profile_side_img">
                    <img src="<?= site_url ?>images/sr/<?= htmlspecialchars($user_data['sr_avatar'], ENT_QUOTES, "UTF-8") ?>" alt="Profile Image">
                </div>
            </div>
            <div class="aside_links">
                <a href="<?= site_url ?>user/dashboard.php"><ion-icon name="grid-outline"></ion-icon> Dashboard Overview</a>
                <a href="<?= site_url ?>user/requests.php"><ion-icon name="document-text-outline"></ion-icon> Requests</a>
                <a href="<?= site_url ?>user/profile.php" class="active"><ion-icon name="person-outline"></ion-icon> Profile</a>
                <a href="<?= site_url ?>index.php"><ion-icon name="home-outline"></ion-icon> Home</a>
                <a href="<?= site_url ?>authentication/logout.php"><ion-icon name="log-out-outline"></ion-icon> Logout</a>
            </div>
        </aside>
        <main>
            <div class="main_navigator">
                <div class="apps" id="openDash" onclick="show_dash()"><ion-icon name="apps-outline"></ion-icon></div>
            </div>
            <div class="profile_overview">
                <div class="left">
                    <img src="<?= site_url ?>images/sr/<?= htmlspecialchars($user_data['sr_avatar'], ENT_QUOTES, "UTF-8") ?>" alt="Profile Image">
                    <ion-icon onclick="window.location.href='<?= site_url ?>user/edit_image.php?uuid=<?= htmlspecialchars($user_data['sr_uuid'], ENT_QUOTES, 'UTF-8') ?>'" class="edit" name="pencil-outline"></ion-icon>
                </div>
                <div class="right">
                    <form class="form_details" action="<?= site_url ?>user/edit_email_logic.php?uuid=<?= htmlspecialchars($user_data['sr_uuid'], ENT_QUOTES, 'UTF-8') ?>" method="post">
                        <h2>Edit details</h2>
                        <input type="email" name="sr_email" value="<?= htmlspecialchars(decrypt($user_data['sr_encrypted_email']), ENT_QUOTES, "UTF-8") ?>">
                        <button type="submit" name="sr_details">Submit</button>
                    </form>
                </div>
            </div>
            <!-- <div class="display_table">Add data to display</div> -->
            <?php if (isset($_SESSION['reset_success'])) : ?>
                <div class="show_alert_success">
                    <?php echo htmlspecialchars($_SESSION['reset_success'], ENT_QUOTES, "UTF-8") ?>
                </div>
            <?php endif ; ?>
            <?php unset($_SESSION['reset_success']) ?>
            <?php if (isset($_SESSION['reset'])) : ?>
                <div class="show_alert_error">
                    <?php echo htmlspecialchars($_SESSION['reset'], ENT_QUOTES, "UTF-8") ?>
                </div>
            <?php endif ; ?>
            <?php unset($_SESSION['reset']) ?>
            <!--email notice-->
            <?php if (isset($_SESSION['edit_email_sr'])) : ?>
                <div class="show_alert_error">
                    <?php echo htmlspecialchars($_SESSION['edit_email_sr'], ENT_QUOTES, "UTF-8") ?>
                </div>
            <?php endif ; ?>
            <?php unset($_SESSION['edit_email_sr']) ?>
        </main>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.js"></script>
    <script src="<?= site_url ?>javascript/script.js"></script>
</body>
</html>