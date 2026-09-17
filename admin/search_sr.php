<?php
    // include files
    require_once '../configuration/database.php';
    require_once '../encryption/encryption.php';
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
    <title>Ema4kids Scholarship Recipients</title>
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
                <a href="<?= site_url ?>admin/blog_overview.php"><ion-icon name="newspaper-outline"></ion-icon> Blog</a>
                <a href="<?= site_url ?>admin/admins.php"><ion-icon name="people-outline"></ion-icon> Admins</a>
                <a href="<?= site_url ?>admin/sr.php" class="active"><ion-icon name="people-circle-outline"></ion-icon> Scholarship Recipients</a>
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
                    <form action="<?= site_url ?>admin/search_sr.php" method="get">
                        <input type="search" name="search" placeholder="Type to search">
                        <button type="submit" name="search_btn"><ion-icon name="search-outline"></ion-icon></button>
                    </form>
                </div>
                <div class="add">
                    <span>Add a Scholarship Recipients</span>
                    <button onclick="window.location.href='<?= site_url ?>admin/add_sr.php'"><ion-icon name="add-outline"></ion-icon></button>
                </div>
            </div>
            <div class="filter_stat">
                <form action="<?= site_url ?>admin/sr_filter_decider.php" method="post">
                    <h4>Filter: </h4>
                    <div class="filt">
                        <button type="submit" name="all">All</button>
                        <?php
                            // select active sr
                            $select_active_sr = mysqli_prepare($conn, "SELECT COUNT(*) AS active_sr FROM sr_tbl WHERE status = ?");
                            // declare status
                            $active_status = "active";
                            // bind parameters
                            mysqli_stmt_bind_param($select_active_sr, "s", $active_status);
                            // execute statement
                            mysqli_stmt_execute($select_active_sr);
                            // get result
                            $active_result = mysqli_stmt_get_result($select_active_sr);
                            if (mysqli_num_rows($active_result) > 0) {
                                $active = mysqli_fetch_assoc($active_result);
                                // declare active sr
                                $active_count = $active['active_sr'];
                            }
                        ?>
                        <button type="submit" name="active">Active (<?= htmlspecialchars($active_count, ENT_QUOTES, "UTF-8") ?>)</button>
                        <?php
                            // select graduated sr
                            $select_graduated_sr = mysqli_prepare($conn, "SELECT COUNT(*) AS graduated_sr FROM sr_tbl WHERE status = ?");
                            // declare status
                            $graduated_status = "graduated";
                            // bind parameters
                            mysqli_stmt_bind_param($select_graduated_sr, "s", $graduated_status);
                            // execute statement
                            mysqli_stmt_execute($select_graduated_sr);
                            // get result
                            $result_graduated = mysqli_stmt_get_result($select_graduated_sr);
                            if (mysqli_num_rows($result_graduated) > 0) {
                                $graduated = mysqli_fetch_assoc($result_graduated);
                                // declare graduated requests
                                $graduated_count = $graduated['graduated_sr'];
                            }
                        ?>
                        <button type="submit" name="graduated">Graduated (<?= htmlspecialchars($graduated_count, ENT_QUOTES, "UTF-8") ?>)</button>
                    </div>
                </form>
                <form action="<?= site_url ?>admin/sr_sort_decider.php" method="post">
                    <h4>Sort: </h4>
                    <div class="filt">
                        <button type="submit" name="ASC">Ascending</button>
                        <button type="submit" name="DESC">Descending</button>
                    </div>
                </form>
            </div>
            <?php
                // get details from url
                if (isset($_GET['search']) && isset($_GET['search_btn'])) {
                    $search = trim((string) $_GET['search']);
                    // select admin from database
                    $select_sr = mysqli_prepare($conn, "SELECT * FROM sr_tbl WHERE sr_firstname LIKE ? OR 
                    sr_lastname LIKE ? OR sr_middlename LIKE ?");
                    // declare search variable
                    $search_like = "%" . $search . "%";
                    // bind parameters 
                    mysqli_stmt_bind_param($select_sr, "sss", $search_like, $search_like, $search_like);
                    // execute statement
                    mysqli_stmt_execute($select_sr);
                    // get results
                    $select_sr = mysqli_stmt_get_result($select_sr);
                    if (mysqli_num_rows($select_sr) > 0) {
                        echo "<table>";
                            echo "<tr>";
                                echo "<th>Name</th>";
                                echo "<th>Email</th>";
                                echo "<th>Request</th>";
                                echo "<th>Total</th>";
                                echo "<th>Date needed</th>";
                                echo "<th>Date created</th>";
                                echo "<th>Status</th>";
                                echo "<th>Edit</th>";
                            echo "</tr>";
                            while ($sr = mysqli_fetch_assoc($select_sr)) {
                                echo "<tr>";
                                    echo "<td>" . htmlspecialchars($sr['sr_lastname'] . " " .  $sr['sr_firstname'] . " " . $sr['sr_middlename'] ?? null, ENT_QUOTES, "UTF-8") . "</td>";
                                    echo "<td>". decrypt(htmlspecialchars($sr['sr_encrypted_email'], ENT_QUOTES, "UTF-8")). "</td>";
                                    echo "<td>" . htmlspecialchars($sr['sr_country'], ENT_QUOTES, "UTF-8") . "</td>";
                                    echo "<td>" . htmlspecialchars($sr['sr_state'], ENT_QUOTES, "UTF-8") . "</td>";
                                    echo "<td>" . htmlspecialchars($sr['status'], ENT_QUOTES, "UTF-8") . "</td>";
                                    echo '<td><a href="' . site_url . 'documents/letter/' . htmlspecialchars($sr['letter'], ENT_QUOTES, "UTF-8") . '" download="">download</a></td>';
                                    echo '<td><a href="edit_admin.php?id=' . htmlspecialchars($sr['sr_uuid'], ENT_QUOTES, 'UTF-8') . '">Click</a></td>';
                                    echo '<td><a href="delete_admin.php?id=' . htmlspecialchars($sr['sr_uuid'], ENT_QUOTES, 'UTF-8') . '" class="danger">Click</a></td>';
                                echo "</tr>";
                            }
                        echo "</table>";
                    } else {
                        echo "<div class='display_table'>Add data to display</div>";
                    }
                }
            ?>
            <?php if (isset($_SESSION['add_request_success'])) : ?>
                <div class="show_alert_success">
                    <?php echo htmlspecialchars($_SESSION['add_request_success'], ENT_QUOTES, "UTF-8") ?>
                </div>
            <?php endif ; ?>
            <?php unset($_SESSION['add_request_success']) ?>
            <?php if (isset($_SESSION['add_request'])) : ?>
                <div class="show_alert_error">
                    <?php echo htmlspecialchars($_SESSION['add_request'], ENT_QUOTES, "UTF-8") ?>
                </div>
            <?php endif ; ?>
            <?php unset($_SESSION['add_request']) ?>
            <!--edit request-->
            <?php if (isset($_SESSION['edit_request_success'])) : ?>
                <div class="show_alert_success">
                    <?php echo htmlspecialchars($_SESSION['edit_request_success'], ENT_QUOTES, "UTF-8") ?>
                </div>
            <?php endif ; ?>
            <?php unset($_SESSION['edit_request_success']) ?>
            <?php if (isset($_SESSION['edit_request'])) : ?>
                <div class="show_alert_error">
                    <?php echo htmlspecialchars($_SESSION['edit_request'], ENT_QUOTES, "UTF-8") ?>
                </div>
            <?php endif ; ?>
            <?php unset($_SESSION['edit_request']) ?>
            <!--edit status-->
            <?php if (isset($_SESSION['edit_status_success'])) : ?>
                <div class="show_alert_success">
                    <?php echo htmlspecialchars($_SESSION['edit_status_success'], ENT_QUOTES, "UTF-8") ?>
                </div>
            <?php endif ; ?>
            <?php unset($_SESSION['edit_status_success']) ?>
            <?php if (isset($_SESSION['edit_status'])) : ?>
                <div class="show_alert_error">
                    <?php echo htmlspecialchars($_SESSION['edit_status'], ENT_QUOTES, "UTF-8") ?>
                </div>
            <?php endif ; ?>
            <?php unset($_SESSION['edit_status']) ?>
        </main>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.js"></script>
    <script src="<?= site_url ?>javascript/script.js"></script>
</body>
</html>