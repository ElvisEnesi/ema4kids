<?php
    // include files
    require_once '../configuration/database.php';
    // get id from url
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
        // get request details
        $select_request = mysqli_prepare($conn, "SELECT status FROM request_tbl WHERE id = ? LIMIT 1");
        // bind parameters
        mysqli_stmt_bind_param($select_request, "i", $id);
        // execute statement
        mysqli_stmt_execute($select_request);
        // get result
        $request_result = mysqli_stmt_get_result($select_request);
        if (mysqli_num_rows($request_result) > 0) {
            $request = mysqli_fetch_assoc($request_result);
        } else {
            $_SESSION['edit_status'] = "Request doesn't exist!";
            header("location: " . site_url . "admin/requests.php");
            exit();
        }
    } else {
        header("location: " . site_url . "admin/requests.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ema4kids Edit Request</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url ?>css/style.css"/>
</head>
<body>
    <div class="success">
        Your current status is: <strong><?= htmlspecialchars($request['status'], ENT_QUOTES, "UTF-8") ?></strong>
    </div>
    <div class="welcome_note">
        <h2>Edit your request status</h2>
    </div>
    <?php if (isset($_SESSION['edit_status'])) : ?>
    <div class="error">
        <?php echo htmlspecialchars($_SESSION['edit_status'], ENT_QUOTES, "UTF-8") ?>
    </div>
    <?php endif; ?>
    <?php unset($_SESSION['edit_status']) ?>
    <div class="form">
        <form action="<?= site_url ?>admin/edit_status_logic.php?id=<?= htmlspecialchars($id, ENT_QUOTES, "UTF-8") ?>" method="post">
            <div class="form-group">
                <label for="role">Status</label><br>
                <select name="status" id="role">
                    <option value="approved">Approve</option>
                    <option value="pending">Pending</option>
                    <option value="correct">Correction</option>
                </select>
            </div>
            <button type="submit" name="edit_status">Edit request</button>
        </form>
    </div>
</body>
</html>