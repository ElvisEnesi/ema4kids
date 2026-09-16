<?php
    // include files
    require_once '../configuration/database.php';
    // declare variables
    $avatar = $_FILES['avatar'];
    $previous_avatar = filter_var($_POST['previous_avatar'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $previous_avatar_path = "../images/sr/" . $previous_avatar;
    // get uuid from url
    if (isset($_GET['uuid'])) {
        $gotten_uuid = filter_var($_GET['uuid'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    } else {
        header("Location: " . site_url . "user/profile.php");
        exit();
    }
    // check if form is submitted
    if (isset($_POST['edit_image_sr'])) {
        // check if there's empty fields
        if (!$avatar['name']) {
            $_SESSION['edit_image_sr'] = "Select an image";
        } else {
            // work on new image
            $avatar_name = time() . "_" . $avatar['name']; // make image unique using timestamp
            $avatar_tmp_name = $avatar['tmp_name'];
            $avatar_destination = "../images/sr/" . $avatar_name;
            // allowed files
            $allowed_files = ['image/jpeg', 'image/png', 'image/jpg'];
            // validate extension
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, $avatar_tmp_name);
            // check array
            if (in_array($mime_type, $allowed_files)) {
                // check file size
                if ($avatar['size'] > 3_000_000) {
                    $_SESSION['edit_image_sr'] = "File must be less than 3mb";
                }
            } else {
                $_SESSION['edit_image_sr'] = "Image must be jpg, jpeg or png";
            }
        }
        // redirect if there's any error
        if (isset($_SESSION['edit_image_sr'])) {
            header("Location: " . site_url . "user/profile.php");
            exit();
        } else {
            // unlink previous image
            if ($previous_avatar_path) {
                unlink($previous_avatar_path);
            }
            // upload new file
            move_uploaded_file($avatar_tmp_name, $avatar_destination);
            // update image in database
            $update = mysqli_prepare($conn, "UPDATE sr_tbl SET sr_avatar = ? WHERE sr_uuid = ?");
            // bind parameters
            mysqli_stmt_bind_param($update, "ss", $avatar_name, $gotten_uuid);
            // execute
            mysqli_stmt_execute($update);
            // check if executed
            if (mysqli_stmt_affected_rows($update) > 0) {
                // redirect with success message
                $_SESSION['reset_success'] = "Image successfully changed!";
                header("location: " . site_url . "user/profile.php");
                exit();
            } else {
                // redirect with error message
                $_SESSION['reset'] = "Couldn't change image, try again!";
                header("location: " . site_url . "user/profile.php");
                exit();
            }
        }
    } else {
        header("Location: " . site_url . "user/profile.php");
        exit();
    }