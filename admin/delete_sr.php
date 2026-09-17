<?php
    // include files
    require_once '../configuration/database.php';
    // get uuid from url
    if (isset($_GET['uuid'])) {
        $uuid = (string) $_GET['uuid'];
    } else {
        // redirect to sr page
        header("location: " . site_url . "admin/sr.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ema4kids Delete Scholarship Recipients</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url ?>css/style.css"/>
</head>
<body>
    <div class="welcome_note">
        <h2>Delete scholarship recipients</h2>
    </div>
    <div class="form">
        <form class="delete" action="<?= site_url ?>admin/delete_sr_logic.php?uuid=<?= htmlspecialchars($uuid, ENT_QUOTES, "UTF-8") ?>" method="post">
            <button type="submit" name="delete_sr">Delete scholarship recipients</button>
        </form>
    </div>
</body>
</html>