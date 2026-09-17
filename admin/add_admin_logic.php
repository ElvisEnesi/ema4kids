<?php
    // include files
    require_once '../configuration/database.php';
    require_once '../encryption/encryption.php';
    if (isset($_POST['add_admin'])) {
        // declare variables
        $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $middlename = filter_var($_POST['middlename'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $country = filter_var($_POST['country'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $state_of_origin = filter_var($_POST['state_of_origin'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $create_password = filter_var($_POST['create_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $avatar = $_FILES['avatar'];
        $cv = $_FILES['cv'];
        $date_of_birth =filter_var($_POST['date_of_birth']);
        $rq_role = filter_var($_POST['rq_role'], FILTER_SANITIZE_NUMBER_INT) ?? null;
        $rp_role = filter_var($_POST['rp_role'], FILTER_SANITIZE_NUMBER_INT) ?? null;
        $bl_role = filter_var($_POST['bl_role'], FILTER_SANITIZE_NUMBER_INT) ?? null;

        // validate inputs
        if (!$firstname || !$lastname || !$email || !$title || !$country ||!$state_of_origin ||
            !$create_password || !$confirm_password || !$avatar['name'] || !$cv['name'])
        {
            $_SESSION['add_admin'] = "Fill in all fields!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['add_admin'] = "Invalid email address!";
        } elseif ($create_password !== $confirm_password) {
            $_SESSION['add_admin'] = "Passwords do not match!";
        } else {
            // generate admin uuid
            function generate_uuidv4() {
                $data = random_bytes(16);

                // Set version to 0100 (Version 4)
                $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
                // Set bits 6-7 to 10 (Variant 1)
                $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

                return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
            }
            $uuid = generate_uuidv4();
            //hash passwords
            $hashed_password = password_hash($confirm_password, PASSWORD_DEFAULT);
            // Extract the domain name from the email
            $email_parts = explode('@', $email);
            $domain = array_pop($email_parts);
            // Verify if the domain has valid MX (Mail Exchanger) records
            if (!checkdnsrr($domain, 'MX')) {
                $_SESSION['add_admin'] = "Email domain does not exist or cannot receive emails!";
            }
            // hash email
            $hashed_email = hash("sha256", $email);
            // encrypt email
            $encrypted_email = encrypt($email);
            // work on avatar
            $avatar_name = time() . "_" . $avatar['name']; // make image unique using timestamp
            $avatar_tmp_name = $avatar['tmp_name'];
            $avatar_file_path = "../images/admin/" . $avatar_name;
            // allowed images
            $allowed_images = ['image/png', 'image/jpg', 'image/jpeg'];
            // validate extension
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, $avatar_tmp_name);
            // check array
            if (in_array($mime_type, $allowed_images)) {
                // check file size
                if ($avatar['size'] > 3_000_000) {
                    $_SESSION['add_admin'] = "File must be less than 3mb";
                }
            } else {
                $_SESSION['add_admin'] = "Image must be jpg, jpeg or png";
            }
            // work on cv
            $cv_name = $firstname . "_" . time() . "_" . $cv['name']; // make image unique using timestamp
            $cv_tmp_name = $cv['tmp_name'];
            $cv_file_path = "../documents/cv/" . $cv_name;
            // allowed images
            $allowed_files = ['pdf', 'doc', 'docx'];
            // validate extension
            $file_finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_mime_type = finfo_file($file_finfo, $cv_tmp_name);
            // check array
            if (in_array($file_mime_type, $allowed_files)) {
                $_SESSION['add_admin'] = "file must be docx, doc or pdf";
            }
        }
        // redirect back to add admin page if there's any error
        if (isset($_SESSION['add_admin'])) {
            header("location: " . site_url . "admin/add_admin.php");
            exit();
        } else {
            // insert into database
            $insert = mysqli_prepare($conn, "INSERT INTO admin_tbl (uuid, firstname, lastname, middlename, encrypted_email, 
            title, country, state, date_of_birth, rq_role, rp_role, bl_role, hashed_password, hashed_email, avatar, cv) 
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            // bind parameters
            mysqli_stmt_bind_param($insert, "sssssssssiiissss", $uuid, $firstname, $lastname, $middlename, 
            $encrypted_email, $title, $country, $state_of_origin, $date_of_birth, $rq_role, $rp_role, $bl_role, $hashed_password,
            $hashed_email, $avatar_name, $cv_name);
            // execute sql statement
            mysqli_stmt_execute($insert);
            if (mysqli_stmt_affected_rows($insert) > 0) {
                // upload image to folder
                move_uploaded_file($avatar_tmp_name, $avatar_file_path);
                // upload file to folder
                move_uploaded_file($cv_tmp_name, $cv_file_path);
                // insert into activity
                $insert_activity = mysqli_prepare($conn, "INSERT INTO activity_log (uuid, activity) VALUES (?,?)");
                // declare activity
                $activity = "Added admin " . $firstname;
                mysqli_stmt_bind_param($insert_activity, "ss", $_SESSION['uuid'], $activity);
                mysqli_stmt_execute($insert_activity);
                mysqli_stmt_close($insert_activity);
                // redirect with message
                $_SESSION['add_admin_success'] = "Admin successfully added!!";
                header("location: " . site_url . "admin/admins.php");
                exit();
            } else {
                $_SESSION['add_admin'] = "Unable to create new admin";
                header("location: " . site_url . "admin/admins.php");
                exit();
            }
            mysqli_stmt_free_result($insert);
            mysqli_stmt_close($insert);
        }
    } else {
        header("location: " . site_url . "admin/add_admin.php");
        exit();
    }
    
