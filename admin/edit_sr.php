<?php
    // include files
    require_once '../configuration/database.php';
    // get uuid from url
    if (isset($_GET['uuid'])) {
        $uuid = (string) $_GET['uuid'];
        // get sr details using uuid from url
        $select = mysqli_prepare($conn, "SELECT sr_uuid, sr_firstname, sr_lastname, sr_middlename, degree
        FROM sr_tbl WHERE sr_uuid = ? LIMIT 1");
        // bind parameters
        mysqli_stmt_bind_param($select, "s", $uuid);
        mysqli_stmt_execute($select);
        $result = mysqli_fetch_assoc(mysqli_stmt_get_result($select));
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
    <title>Ema4kids Edit Scholarship Recipient</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url ?>css/style.css"/>
</head>
<body>
    <div class="welcome_note">
        <h2>Edit Scholarship Recipient</h2>
    </div>
    <?php if (isset($_SESSION['edit_sr'])) : ?>
    <div class="error">
        <?php echo htmlspecialchars($_SESSION['edit_sr'], ENT_QUOTES, "UTF-8") ?>
    </div>
    <?php endif ; ?>
    <?php unset($_SESSION['edit_sr']) ?>
    <div class="form">
        <form action="<?= site_url ?>admin/edit_sr_logic.php?uuid=<?= htmlspecialchars($uuid, ENT_QUOTES, "UTF-8") ?>" method="post">
            <div class="form-group">
                <label for="name">First Name</label>
                <input type="text" id="name" name="firstname" value="<?= htmlspecialchars($result['sr_firstname'], ENT_QUOTES, "UTF-8") ?>">
            </div>
            <div class="form-group">
                <label for="name">Last Name</label>
                <input type="text" id="name" name="lastname" value="<?= htmlspecialchars($result['sr_lastname'], ENT_QUOTES, "UTF-8") ?>">
            </div>
            <div class="form-group">
                <label for="name">Middle Name</label>
                <input type="text" id="name" name="middlename" value="<?= htmlspecialchars($result['sr_middlename'], ENT_QUOTES, "UTF-8") ?>">
            </div>
            <div class="form-group">
                <label for="degree">Degree</label>
                <input type="text" id="degree" name="degree" value="<?= htmlspecialchars($result['degree'], ENT_QUOTES, "UTF-8") ?>">
            </div>
            <div class="form-group">
                <label for="role">Status</label>
                <select name="status" id="role">
                    <option value="active">Active</option>
                    <option value="graduated">Graduated</option>
                </select>
            </div>
            <button type="submit" name="edit_sr">Edit scholarship recipient</button>
        </form>
    </div>
</body>
</html>