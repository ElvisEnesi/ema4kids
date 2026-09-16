<?php
    // include files
    require_once '../configuration/database.php';
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
    <title>Scholarship Recipients Dashboard</title>
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
                <a href="<?= site_url ?>user/dashboard.php" class="active"><ion-icon name="grid-outline"></ion-icon> Dashboard Overview</a>
                <a href="<?= site_url ?>user/requests.php"><ion-icon name="document-text-outline"></ion-icon> Requests</a>
                <a href="<?= site_url ?>user/profile.php"><ion-icon name="person-outline"></ion-icon> Profile</a>
                <a href="<?= site_url ?>index.php"><ion-icon name="home-outline"></ion-icon> Home</a>
                <a href="<?= site_url ?>authentication/logout.php"><ion-icon name="log-out-outline"></ion-icon> Logout</a>
            </div>
        </aside>
        <main>
            <div class="main_navigator">
                <div class="apps" id="openDash" onclick="show_dash()"><ion-icon name="apps-outline"></ion-icon></div>
            </div>
            <div class="greet">Welcome back, <?= htmlspecialchars($user_data['sr_lastname'] . " " . $user_data['sr_firstname'] . " " . $user_data['sr_middlename'], ENT_QUOTES, "UTF-8") ?> &#128075;</div>
            <div class="overview">
                <div class="overview_card">
                    <h3>New Requests</h3>
                    <div class="overview_details">
                        <span class="overview_count">12</span>
                        <p>Requests</p>
                    </div>
                </div>
                <div class="overview_card">
                    <h3>Pending Requests</h3>
                    <div class="overview_details">
                        <span class="overview_count">12</span>
                        <p>Pending</p>
                    </div>
                </div>
                <div class="overview_card">
                    <h3>Blog activities</h3>
                    <div class="overview_details">
                        <span class="overview_count">12</span>
                        <p>Activities</p>
                    </div>
                </div>
                <div class="overview_card">
                    <h3>New threats</h3>
                    <div class="overview_details">
                        <span class="overview_count">12</span>
                        <p>Threats</p>
                    </div>
                </div>
            </div>
            <h2>Your recent activities</h2>
            <?php
                // select admin from database
                $select_activity = mysqli_prepare($conn, "SELECT ac.uuid AS uuid, ac.activity AS activity, ac.date AS date, sr.sr_uuid 
                AS sr_uuid, sr.sr_encrypted_email AS email FROM activity_log AS ac JOIN sr_tbl AS sr ON ac.uuid = sr.sr_uuid
                WHERE sr.sr_uuid = ? ORDER BY ac.date DESC");
                //bind parameters
                mysqli_stmt_bind_param($select_activity, "s", $logged_in_user);
                mysqli_stmt_execute($select_activity);
                $select_activity = mysqli_stmt_get_result($select_activity);
                //
                if (mysqli_num_rows($select_activity) > 0) :
                ?>
                <table>
                    <tr>
                        <th>Activity</th>
                        <th>Email</th>
                        <th>Date</th>
                    </tr>
                    <?php while ($activity = mysqli_fetch_assoc($select_activity)) : ?>
                        <tr>
                            <td><?= htmlspecialchars($activity['activity'], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= decrypt(htmlspecialchars($activity['email'], ENT_QUOTES, "UTF-8")) ?></td>
                            <td><?= htmlspecialchars($activity['date'], ENT_QUOTES, "UTF-8") ?></td>
                        </tr>
                    <?php endwhile ; ?>
                </table>
            <?php else : ?>
                <div class="display_table">Add data to display</div>
            <?php endif ; ?>
        </main>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.js"></script>
    <script src="<?= site_url ?>javascript/script.js"></script>
</body>
</html>