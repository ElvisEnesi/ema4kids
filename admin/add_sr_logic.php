<?php
    // include files
    require_once '../configuration/database.php';
    require_once '../encryption/encryption.php';
    if (isset($_POST['add_sr'])) {
        // declare variables
        $firstname = (string) $_POST['firstname'];
        $lastname = (string) $_POST['lastname'];
        $middlename = (string) $_POST['middlename'] ?? null;
        $email = (string) $_POST['email'];
        $country = (string) $_POST['country'];
        $state_of_origin = (string) $_POST['state_of_origin'];
        $create_password = (string) $_POST['create_password'];
        $confirm_password = (string) $_POST['confirm_password'];
        $avatar = $_FILES['avatar'];
        $letter = $_FILES['letter'];
        $date_of_birth = $_POST['date_of_birth'];
        $status = (string) $_POST['status'];
        $degree = (string) $_POST['degree'];

        // validate inputs
        if (!$firstname || !$lastname || !$email || !$country || !$state_of_origin || !$create_password || !$confirm_password 
        || !$avatar['name'] || !$letter['name'] || !$status || !$date_of_birth || !$degree)
        {
            $_SESSION['add_sr'] = "Fill in all fields!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['add_sr'] = "Invalid email address!";
        } elseif ($create_password !== $confirm_password) {
            $_SESSION['add_sr'] = "Passwords do not match!";
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
                $_SESSION['add_sr'] = "Email domain does not exist or cannot receive emails!";
            }
            // hash email
            $hashed_email = hash("sha256", $email);
            // encrypt email
            $encrypted_email = encrypt($email);
            // work on avatar
            $avatar_name = time() . "_" . $avatar['name']; // make image unique using timestamp
            $avatar_tmp_name = $avatar['tmp_name'];
            $avatar_file_path = "../images/sr/" . $avatar_name;
            // allowed images
            $allowed_images = ['image/png', 'image/jpg', 'image/jpeg'];
            // validate extension
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, $avatar_tmp_name);
            // check array
            if (in_array($mime_type, $allowed_images)) {
                // check file size
                if ($avatar['size'] > 3_000_000) {
                    $_SESSION['add_sr'] = "File must be less than 3mb";
                }
            } else {
                $_SESSION['add_sr'] = "Image must be jpg, jpeg or png";
            }
            // work on letter
            $letter_name = $firstname . "_" . time() . "_" . $letter['name']; // make image unique using timestamp
            $letter_tmp_name = $letter['tmp_name'];
            $letter_file_path = "../documents/letter/" . $letter_name;
            // allowed images
            $allowed_files = ['pdf', 'doc', 'docx'];
            // validate extension
            $file_finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_mime_type = finfo_file($file_finfo, $letter_tmp_name);
            // check array
            if (in_array($file_mime_type, $allowed_files)) {
                $_SESSION['add_sr'] = "file must be docx, doc or pdf";
            }
        }
        // redirect back to add admin page if there's any error
        if (isset($_SESSION['add_sr'])) {
            header("location: " . site_url . "admin/add_sr.php");
            exit();
        } else {
            // insert into database
            $insert = mysqli_prepare($conn, "INSERT INTO sr_tbl (sr_uuid, sr_firstname, sr_lastname, sr_middlename, 
            sr_encrypted_email, sr_country, degree, sr_state, sr_date_of_birth, status, hashed_password, sr_hashed_email, 
            sr_avatar, letter) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            // bind parameters
            mysqli_stmt_bind_param($insert, "ssssssssssssss", $uuid, $firstname, $lastname, $middlename, 
            $encrypted_email, $country, $degree, $state_of_origin, $date_of_birth, $status, $hashed_password,
            $hashed_email, $avatar_name, $letter_name);
            // execute sql statement
            mysqli_stmt_execute($insert);
            if (mysqli_stmt_affected_rows($insert) > 0) {
                // insert into activity
                $insert_activity = mysqli_prepare($conn, "INSERT INTO activity_log (uuid, activity) VALUES (?,?)");
                // declare activity
                $activity = "Added scholarship recipient " . $firstname;
                mysqli_stmt_bind_param($insert_activity, "ss", $_SESSION['uuid'], $activity);
                mysqli_stmt_execute($insert_activity);
                mysqli_stmt_close($insert_activity);
                // upload image to folder
                move_uploaded_file($avatar_tmp_name, $avatar_file_path);
                // upload file to folder
                move_uploaded_file($letter_tmp_name, $letter_file_path);
                $_SESSION['add_sr_success'] = "Scholarship Recipient successfully added!!";
                header("location: " . site_url . "admin/sr.php");
                exit();
            } else {
                $_SESSION['add_sr'] = "Unable to create new admin";
                header("location: " . site_url . "admin/sr.php");
                exit();
            }
        }
    } else {
        header("location: " . site_url . "admin/add_sr.php");
        exit();
    }
    
