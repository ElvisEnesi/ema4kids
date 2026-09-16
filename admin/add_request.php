<?php
    // include files
    require_once '../configuration/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ema4kids Make Request</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url ?>css/style.css"/>
</head>
<body>
    <div class="welcome_note">
        <h2>Make a request</h2>
    </div>
    <?php if (isset($_SESSION['add_request'])) : ?>
    <div class="error">
        <?php echo htmlspecialchars($_SESSION['add_request'], ENT_QUOTES, "UTF-8") ?>
    </div>
    <?php endif; ?>
    <?php unset($_SESSION['add_request']) ?>
    <div class="form">
        <form action="<?= site_url ?>admin/add_request_logic.php" method="post">
            <div class="form-group">
                <label for="request">Description</label>
                <textarea name="description" id="request" placeholder="Your request!!"></textarea>
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
                <input type="number" id="total" name="total">
            </div>
            <div class="form-group">
                <label for="date_of_request">Date needed for the request</label>
                <input type="date" id="date_of_request" name="date_of_request">
            </div>
            <button type="submit" name="request">Submit request</button>
        </form>
    </div>
</body>
</html>