<?php
    // include files
    require_once '../configuration/database.php';
    require_once '../encryption/encryption.php';
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
    <title>Ema4kids Requests</title>
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
                <a href="<?= site_url ?>user/dashboard.php"><ion-icon name="grid-outline"></ion-icon> Dashboard Overview</a>
                <a href="<?= site_url ?>user/requests.php" class="active"><ion-icon name="document-text-outline"></ion-icon> Requests</a>
                <a href="<?= site_url ?>user/profile.php"><ion-icon name="person-outline"></ion-icon> Profile</a>
                <a href="<?= site_url ?>index.php"><ion-icon name="home-outline"></ion-icon> Home</a>
                <a href="<?= site_url ?>authentication/logout.php"><ion-icon name="log-out-outline"></ion-icon> Logout</a>
            </div>
        </aside>
        <main>
            <div class="main_navigator">
                <div class="apps" id="openDash" onclick="show_dash()"><ion-icon name="apps-outline"></ion-icon></div>
                <div class="search">
                    <form action="<?= site_url ?>user/search_request.php" method="get">
                        <input type="search" name="search" placeholder="Type to search">
                        <button type="submit" name="search_btn"><ion-icon name="search-outline"></ion-icon></button>
                    </form>
                </div>
                <div class="add">
                    <span>Make a new request</span>
                    <button onclick="window.location.href='<?= site_url ?>user/add_request.php'"><ion-icon name="add-outline"></ion-icon></button>
                </div>
            </div>
            <div class="filter_stat">
                <form action="<?= site_url ?>user/requests_filter_decider.php" method="post">
                    <h4>Filter: </h4>
                    <div class="filt">
                        <button type="submit" name="all">All</button>
                        <?php
                            // select approved requests
                            $select_approved_requests = mysqli_prepare($conn, "SELECT COUNT(*) AS approved_requests FROM request_tbl WHERE status = ? AND user_uuid = ?");
                            // declare status
                            $approved_status = "approved";
                            // bind parameters
                            mysqli_stmt_bind_param($select_approved_requests, "ss", $approved_status, $_SESSION['uuid']);
                            // execute statement
                            mysqli_stmt_execute($select_approved_requests);
                            // get result
                            $result_approved = mysqli_stmt_get_result($select_approved_requests);
                            if (mysqli_num_rows($result_approved) > 0) {
                                $approved = mysqli_fetch_assoc($result_approved);
                                // declare pending requests
                                $approved_count = $approved['approved_requests'];
                            }
                        ?>
                        <button type="submit" name="approved">Approved (<?= htmlspecialchars($approved_count, ENT_QUOTES, "UTF-8") ?>)</button>
                        <?php
                            // select pending requests
                            $select_pending_requests = mysqli_prepare($conn, "SELECT COUNT(*) AS pending_requests FROM request_tbl WHERE status = ? AND user_uuid = ?");
                            // declare status
                            $pending_status = "pending";
                            // bind parameters
                            mysqli_stmt_bind_param($select_pending_requests, "ss", $pending_status, $_SESSION['uuid']);
                            // execute statement
                            mysqli_stmt_execute($select_pending_requests);
                            // get result
                            $result_pending = mysqli_stmt_get_result($select_pending_requests);
                            if (mysqli_num_rows($result_pending) > 0) {
                                $pending = mysqli_fetch_assoc($result_pending);
                                // declare pending requests
                                $pending_count = $pending['pending_requests'];
                            }
                        ?>
                        <button type="submit" name="pending">Pending (<?= htmlspecialchars($pending_count, ENT_QUOTES, "UTF-8") ?>)</button>
                        <?php
                            // select corrected requests
                            $select_corrected_requests = mysqli_prepare($conn, "SELECT COUNT(*) AS corrected_requests FROM request_tbl WHERE status = ? AND user_uuid = ?");
                            // declare status
                            $corrected_status = "correct";
                            // bind parameters
                            mysqli_stmt_bind_param($select_corrected_requests, "ss", $corrected_status, $_SESSION['uuid']);
                            // execute statement
                            mysqli_stmt_execute($select_corrected_requests);
                            // get result
                            $result_corrected = mysqli_stmt_get_result($select_corrected_requests);
                            if (mysqli_num_rows($result_corrected) > 0) {
                                $corrected = mysqli_fetch_assoc($result_corrected);
                                // declare corrected requests
                                $corrected_count = $corrected['corrected_requests'];
                            }
                        ?>
                        <button type="submit" name="correct">Corrections (<?= htmlspecialchars($corrected_count, ENT_QUOTES, "UTF-8") ?>)</button>
                    </div>
                </form>
                <form action="<?= site_url ?>user/request_sort_decider.php" method="post">
                    <h4>Sort: </h4>
                    <div class="filt">
                        <button type="submit" name="ASC">Ascending</button>
                        <button type="submit" name="DESC">Descending</button>
                    </div>
                </form>
            </div>
            <?php
                // get details from url
                if (isset($_GET['filter'])) {
                    $filter = (string) $_GET['filter'];
                    // select request from database
                    $select_request = mysqli_prepare($conn, "SELECT * FROM request_tbl WHERE status = ? AND user_uuid = ? ORDER BY date_created DESC");
                    // bind parameters
                    mysqli_stmt_bind_param($select_request, "ss", $filter, $_SESSION['uuid']);
                    // execute statement
                    mysqli_stmt_execute($select_request);
                    // get results
                    $select_request = mysqli_stmt_get_result($select_request);
                    if (mysqli_num_rows($select_request) > 0) {
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
                            while ($request = mysqli_fetch_assoc($select_request)) {
                                echo "<tr>";
                                    echo "<td>" . htmlspecialchars($request['lastname'] . " " .  $request['firstname'] . " " . $request['middlename'] ?? null, ENT_QUOTES, "UTF-8") . "</td>";
                                    echo "<td>". decrypt(htmlspecialchars($request['encrypted_email'], ENT_QUOTES, "UTF-8")). "</td>";
                                    echo "<td>" . htmlspecialchars($request['description'], ENT_QUOTES, "UTF-8") . "</td>";
                                    echo "<td>" . htmlspecialchars($request['currency'], ENT_QUOTES, "UTF-8"). "" . number_format(htmlspecialchars($request['total'], ENT_QUOTES, "UTF-8"), 2) . "</td>";
                                    echo "<td>" . date("d M, Y", strtotime($request['date_needed'])) . "</td>";
                                    echo "<td>" . date("d M, Y", strtotime($request['date_created'])) . "</td>";
                                    echo '<td><a href="edit_status.php?id=' . htmlspecialchars($request['id'], ENT_QUOTES, 'UTF-8') . '">Click</a></td>';
                                    if ($request['status'] === "approved") {
                                        echo "<td>Unavailable</td>";
                                    } else {
                                        echo '<td><a href="edit_request.php?id=' . htmlspecialchars($request['id'], ENT_QUOTES, 'UTF-8') . '">Click</a></td>';
                                    }
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