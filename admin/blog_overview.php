<?php
    // include files
    require_once '../configuration/database.php';
    // define logged in user
    $logged_in_user = $_SESSION['uuid'];
    // select user from database
    $user_select = mysqli_prepare($conn, "SELECT * FROM admin_tbl WHERE uuid = ?");
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
    <title>Ema4kids Blog Overview</title>
    <link rel="stylesheet" href="<?= site_url ?>css/style.css">
</head>
<body>
    <div class="dashboard_container">
        <aside>
            <div class="apps_close" id="closeDash" onclick="hide_dash()"><ion-icon name="close-outline"></ion-icon></div>
            <div class="aside_header">
                <div class="profile_logo">Ema4kids</div>
                <div class="profile_side_img">
                    <img src="<?= site_url ?>images/admin/<?= htmlspecialchars($user_data['avatar'], ENT_QUOTES, "UTF-8") ?>" alt="Profile Image">
                </div>
            </div>
            <div class="aside_links">
                <a href="<?= site_url ?>admin/dashboard.php"><ion-icon name="grid-outline"></ion-icon> Dashboard Overview</a>
                <a href="<?= site_url ?>admin/requests.php"><ion-icon name="document-text-outline"></ion-icon> Requests</a>
                <a href="<?= site_url ?>admin/blog_overview.php" class="active"><ion-icon name="newspaper-outline"></ion-icon> Blog</a>
                <a href="<?= site_url ?>admin/admins.php"><ion-icon name="people-outline"></ion-icon> Admins</a>
                <a href="<?= site_url ?>admin/sr.php"><ion-icon name="people-circle-outline"></ion-icon> Scholarship Recipients</a>
                <a href="<?= site_url ?>admin/security.php"><ion-icon name="bug-outline"></ion-icon> Security Alerts</a>
                <a href="<?= site_url ?>admin/activity.php"><ion-icon name="finger-print-outline"></ion-icon> Activity Log</a>
                <a href="<?= site_url ?>admin/profile.php"><ion-icon name="person-outline"></ion-icon> Profile</a>
                <a href="<?= site_url ?>index.php"><ion-icon name="home-outline"></ion-icon> Home</a>
                <a href="<?= site_url ?>authentication/logout.php"><ion-icon name="log-out-outline"></ion-icon> Logout</a>
            </div>
        </aside>
        <main>
            <div class="main_navigator">
                <div class="apps" id="openDash" onclick="show_dash()"><ion-icon name="apps-outline"></ion-icon></div>
                <div class="search">
                    <form action="" method="post">
                        <input type="search" placeholder="Type to search">
                        <button type="submit"><ion-icon name="search-outline"></ion-icon></button>
                    </form>
                </div>
                <div class="add">
                    <span>Make a new blog</span>
                    <button onclick="window.location.href='<?= site_url ?>admin/add_blog.php'"><ion-icon name="add-outline"></ion-icon></button>
                </div>
            </div>
            <div class="filter_stat">
                <form action="" method="get">
                    <h4>Filter: </h4>
                    <div class="filt">
                        <button type="submit" name="all">All</button>
                        <button type="submit" name="published">Published (0)</button>
                        <button type="submit" name="draft">Draft (0)</button>
                        <button type="submit" name="scheduled">Scheduled (0)</button>
                    </div>
                </form>
                <form action="" method="get">
                    <h4>Sort: </h4>
                    <div class="filt">
                        <button type="submit" name="asc">Ascending</button>
                        <button type="submit" name="desc">Descending</button>
                    </div>
                </form>
            </div>
            <table>
                <tr>
                    <th>name</th>
                    <th>Title</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <tr>
                    <td>demo</td>
                    <td>demo</td>
                    <td><a href="<?= site_url ?>admin/edit_blog.php">Click</a></td>
                    <td><a href="<?= site_url ?>admin/delete_blog.php" class="danger">Click</a></td>
                </tr>
            </table>
            <!-- <div class="display_table">Add data to display</div> -->
            <!-- <div class="show_alert_success">
                Profile edited successfully
            </div>
            <div class="show_alert_error">
                Update failed
            </div> -->
        </main>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.js"></script>
    <script src="<?= site_url ?>javascript/script.js"></script>
</body>
</html>