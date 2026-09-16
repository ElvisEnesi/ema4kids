<?php
    // include files
    require_once '../configuration/database.php';
    // get uuid from url
    if (isset($_GET['uuid'])) {
        $gotten_uuid = filter_var($_GET['uuid'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // select user from database
        $user_select = mysqli_prepare($conn, "SELECT * FROM sr_tbl WHERE sr_uuid = ?");
        mysqli_stmt_bind_param($user_select, "s", $gotten_uuid);
        mysqli_stmt_execute($user_select);
        $user_result = mysqli_stmt_get_result($user_select);
        $user_data = mysqli_fetch_assoc($user_result);
    } else {
        header("Location: " . site_url . "user/profile.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ema4kids Edit Image</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url ?>css/style.css"/>
</head>
<body>
    <div class="welcome_note">
        <h2>Edit image</h2>
    </div>
    <?php if (isset($_SESSION['edit_image_sr'])) : ?>
    <div class="error">
        <?php echo htmlspecialchars($_SESSION['edit_image_sr'], ENT_QUOTES, "UTF-8") ?>
    </div>
    <?php endif ; ?>
    <?php unset($_SESSION['edit_image_sr']) ?>
    <div class="form">
        <form action="<?= site_url ?>user/edit_image_logic.php?uuid=<?= htmlspecialchars($gotten_uuid, ENT_QUOTES, 'UTF-8') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input type="file" id="avatar" name="avatar">
                <input type="hidden" name="previous_avatar" value="<?= htmlspecialchars($user_data['sr_avatar'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <button type="submit" name="edit_image_sr">Edit</button>
        </form>
    </div>
</body>
</html>