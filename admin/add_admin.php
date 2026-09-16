<?php
    // include files
    require_once '../configuration/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ema4kids Add Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url ?>css/style.css"/>
</head>
<body>
    <div class="welcome_note">
        <h2>Add an admin</h2>
    </div>
    <?php if (isset($_SESSION['add_admin'])) : ?>
    <div class="error">
        <?php echo htmlspecialchars($_SESSION['add_admin'], ENT_QUOTES, "UTF-8") ?>
    </div>
    <?php endif ; ?>
    <?php unset($_SESSION['add_admin']) ?>
    <div class="form">
        <form action="<?= site_url ?>admin/add_admin_logic.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">First Name</label>
                <input type="text" id="name" name="firstname">
            </div>
            <div class="form-group">
                <label for="name">Last Name</label>
                <input type="text" id="name" name="lastname">
            </div>
            <div class="form-group">
                <label for="name">Middle Name</label>
                <input type="text" id="name" name="middlename">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Executive Director........etc">
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" id="country" name="country">
            </div>
            <div class="form-group">
                <label for="state">State of Origin</label>
                <input type="text" id="state" name="state_of_origin">
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
            <div class="form-group">
                <label for="create_password">Create Password</label>
                <input type="password" id="create_password"  name="create_password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password">
            </div>
            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input type="file" id="avatar" name="avatar">
            </div>
            <div class="form-group">
                <label for="avatar">CV</label>
                <input type="file" id="avatar" name="cv">
            </div>
            <div class="form-group">
                <label for="DOB">Date of Birth</label>
                <input type="date" id="DOB" name="date_of_birth">
            </div>
            <button type="submit" name="add_admin">Sign Up</button>
        </form>
    </div>
</body>
</html>