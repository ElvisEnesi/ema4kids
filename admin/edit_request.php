<?php
    // include files
    require_once '../configuration/database.php';
    // get id from url
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
        // get request details
        $select_request = mysqli_prepare($conn, "SELECT description, total, date_needed FROM request_tbl WHERE id = ? LIMIT 1");
        // bind parameters
        mysqli_stmt_bind_param($select_request, "i", $id);
        // execute statement
        mysqli_stmt_execute($select_request);
        // get result
        $request_result = mysqli_stmt_get_result($select_request);
        if (mysqli_num_rows($request_result) > 0) {
            $request = mysqli_fetch_assoc($request_result);
        } else {
            $_SESSION['edit_request'] = "Request doesn't exist!";
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
    <div class="welcome_note">
        <h2>Edit your request</h2>
    </div>
    <?php if (isset($_SESSION['edit_request'])) : ?>
    <div class="error">
        <?php echo htmlspecialchars($_SESSION['edit_request'], ENT_QUOTES, "UTF-8") ?>
    </div>
    <?php endif; ?>
    <?php unset($_SESSION['edit_request']) ?>
    <div class="form">
        <form action="<?= site_url ?>admin/edit_request_logic.php?id=<?= htmlspecialchars($id, ENT_QUOTES, "UTF-8") ?>" method="post">
            <div class="form-group">
                <label for="request">Description</label>
                <textarea name="description" id="request" placeholder="Your request!!">
                    <?= htmlspecialchars($request['description'], ENT_QUOTES, "UTF-8") ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="role">Currency</label>
                <select name="currency" id="role">
                    <option value="₦">Naira (₦)</option>
                    <option value="$">Dollar ($)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="total">Total</label>
                <input type="number" id="total" name="total" value="<?= htmlspecialchars($request['total'], ENT_QUOTES, "UTF-8") ?>">
            </div>
            <div class="form-group">
                <label for="date_of_request">Date needed for the request</label>
                <input type="date" id="date_of_request" name="date_of_request">
            </div>
            <button type="submit" name="edit_request">Edit request</button>
        </form>
    </div>
</body>
</html>