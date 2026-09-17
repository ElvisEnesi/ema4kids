<?php
    // include files
    require_once '../configuration/database.php';
    // get uuid from url
    if (isset($_GET['uuid'])) {
        $uuid = (string) $_GET['uuid'];
        // get admin details using uuid from url
        $select = mysqli_prepare($conn, "SELECT uuid, firstname, lastname, middlename, title, rq_role, rp_role, bl_role
        FROM admin_tbl WHERE uuid = ? LIMIT 1");
        // bind parameters
        mysqli_stmt_bind_param($select, "s", $uuid);
        mysqli_stmt_execute($select);
        $result = mysqli_fetch_assoc(mysqli_stmt_get_result($select));
    } else {
        // redirect to admins page
        header("location: " . site_url . "admin/admins.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ema4kids Edit Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url ?>css/style.css"/>
</head>
<body>
    <div class="welcome_note">
        <h2>Edit admin</h2>
    </div>
    <?php if (isset($_SESSION['edit_admin'])) : ?>
    <div class="error">
        <?php echo htmlspecialchars($_SESSION['edit_admin'], ENT_QUOTES, "UTF-8") ?>
    </div>
    <?php endif ; ?>
    <?php unset($_SESSION['edit_admin']) ?>
    <div class="form">
        <form action="<?= site_url ?>admin/edit_admin_logic.php?uuid=<?= htmlspecialchars($uuid, ENT_QUOTES, "UTF-8") ?>" method="post">
            <div class="form-group">
                <label for="name">First Name</label>
                <input type="text" id="name" name="firstname" value="<?= htmlspecialchars($result['firstname'], ENT_QUOTES, "UTF-8") ?>">
            </div>
            <div class="form-group">
                <label for="name">Last Name</label>
                <input type="text" id="name" name="lastname" value="<?= htmlspecialchars($result['lastname'], ENT_QUOTES, "UTF-8") ?>">
            </div>
            <div class="form-group">
                <label for="name">Middle Name</label>
                <input type="text" id="name" name="middlename" value="<?= htmlspecialchars($result['middlename'], ENT_QUOTES, "UTF-8") ?>">
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Executive Director........etc" value="<?= htmlspecialchars($result['title'], ENT_QUOTES, "UTF-8") ?>">
            </div>
            <div class="form-group">
                <label for="role">Request role</label>
                <select name="rq_role" id="role">
                    <option value="1">Administrator</option>
                    <option value="0">Viewer</option>
                    <option value="">None</option>
                </select>
            </div>
            <div class="form-group">
                <label for="role">Reciept role</label>
                <select name="rp_role" id="role">
                    <option value="1">Administrator</option>
                    <option value="0">None</option>
                </select>
            </div>
            <div class="form-group">
                <label for="role">Blog role</label>
                <select name="bl_role" id="role">
                    <option value="1">Administrator</option>
                    <option value="0">Blog Editor</option>
                    <option value="">None</option>
                </select>
            </div>
            <button type="submit" name="edit_admin">Edit admin</button>
        </form>
    </div>
</body>
</html>