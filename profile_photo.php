<?php
require_once('class/setup.php');
require_once('class/user.php');
require_once('plugins/message.class.php');

$messages = new message();
$user = new user();

$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml"));
// $smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 2));

$user_id = $_SESSION['user_id'];
$employee_role = $user->user_role($user_id);
$smarty->assign('employee_role', $employee_role);
// if(!empty($_POST)){
//     echo "<pre>".print_r($_POST, 1)."<pre>"; 
//     echo "<pre>".print_r($_FILES, 1)."<pre>";
//     exit();
// }
$uploaded = 0;
if($_POST['upload']) {
    $uploaded = 1;
}

$croped = 0;
if($_POST['upload_thumbnail']) {
    $croped = 1;
}

$upload_path = $user->get_folder_name($_SESSION['company_id']) . '/profile/';
if (!is_dir($app_dir . "/" . $upload_path)) {
    mkdir($app_dir . "/" . $upload_path, 0777);
}


if ($_GET['act'] == "delete" && strlen($_GET['user']) > 0) {
    // get the file locations 
    $user_id = $_GET['user'];
    $user_image = $user->get_user_picture($user_id);
    $image_location = $upload_path . $user_image;
    if (file_exists($image_location)) {
        unlink($image_location);
        $user->update_user_picture($user_id, '');
    }
    header("location:" . $_SERVER["PHP_SELF"]);
    exit();
}

$large_image_prefix = "resize_";
$large_image_name = $large_image_prefix . $user_id;
$thumb_image_name = $user_id;
$max_file = "3";
$max_width = "500";
$thumb_width = "250";
$thumb_height = "250";
// Only one of these image types should be allowed for upload
$allowed_image_types = array('image/pjpeg' => "jpg", 'image/jpeg' => "jpg", 'image/jpg' => "jpg", 'image/png' => "png", 'image/x-png' => "png", 'image/gif' => "gif");
$allowed_image_ext = array_unique($allowed_image_types);
$image_ext = "";
foreach ($allowed_image_ext as $mime_type => $ext) {
    $image_ext.= strtoupper($ext) . " ";
}

function resizeImage($image, $width, $height, $scale) {
    list($imagewidth, $imageheight, $imageType) = getimagesize($image);
    $imageType = image_type_to_mime_type($imageType);
    $newImageWidth = ceil($width * $scale);
    $newImageHeight = ceil($height * $scale);
    $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
    switch ($imageType) {
        case "image/gif":
            $source = imagecreatefromgif($image);
            break;
        case "image/pjpeg":
        case "image/jpeg":
        case "image/jpg":
            $source = imagecreatefromjpeg($image);
            break;
        case "image/png":
        case "image/x-png":
            $source = imagecreatefrompng($image);
            break;
    }
    imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $width, $height);

    switch ($imageType) {
        case "image/gif":
            imagegif($newImage, $image);
            break;
        case "image/pjpeg":
        case "image/jpeg":
        case "image/jpg":
            imagejpeg($newImage, $image, 90);
            break;
        case "image/png":
        case "image/x-png":
            imagepng($newImage, $image);
            break;
    }

    chmod($image, 0777);
    return $image;
}

//You do not need to alter these functions
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale) {
    list($imagewidth, $imageheight, $imageType) = getimagesize($image);
    $imageType = image_type_to_mime_type($imageType);

    $newImageWidth = ceil($width * $scale);
    $newImageHeight = ceil($height * $scale);
    $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
    switch ($imageType) {
        case "image/gif":
            $source = imagecreatefromgif($image);
            break;
        case "image/pjpeg":
        case "image/jpeg":
        case "image/jpg":
            $source = imagecreatefromjpeg($image);
            break;
        case "image/png":
        case "image/x-png":
            $source = imagecreatefrompng($image);
            break;
    }
    imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);
    switch ($imageType) {
        case "image/gif":
            imagegif($newImage, $thumb_image_name);
            break;
        case "image/pjpeg":
        case "image/jpeg":
        case "image/jpg":
            imagejpeg($newImage, $thumb_image_name, 90);
            break;
        case "image/png":
        case "image/x-png":
            imagepng($newImage, $thumb_image_name);
            break;
    }
    chmod($thumb_image_name, 0777);
    return $thumb_image_name;
}

//You do not need to alter these functions
function getHeight($image) {
    $height = 0;
    if($image && file_exists($image)){
        $size = getimagesize($image);
        $height = $size[1];
    }
    return $height;
}

//You do not need to alter these functions
function getWidth($image) {
    $width = 0;
    if($image && file_exists($image)){
        $size = getimagesize($image);
        $width = $size[0];
    }
    return $width;
}

//Image Locations
if($uploaded && $_FILES['image']['name'] != '') {
    $filename = basename($_FILES['image']['name']);
    $file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
    $profile_image_name = $thumb_image_name . '.' . $file_ext;
    $profile_large_image_name = $large_image_name . '.' . $file_ext;
    $large_image_location = $upload_path . $large_image_name . '.' . $file_ext;
    $thumb_image_location = $upload_path . $thumb_image_name . '.' . $file_ext;
} else if($croped) {
    $filename = basename($_POST['filename']);
    $file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
    $profile_image_name = $thumb_image_name . '.' . $file_ext;
    $large_image_location = $upload_path . $large_image_name . '.' . $file_ext;
    $thumb_image_location = $upload_path . $thumb_image_name . '.' . $file_ext;
} else {
    $profile_image_name = $user->get_user_picture($user_id);
    if($profile_image_name) {
        $large_image_location = $upload_path . $profile_image_name;
        $thumb_image_location = $upload_path . $profile_image_name;
    } else {
        $large_image_location = '';
        $thumb_image_location = '';
    }
}

//Create the upload directory with the right permissions if it doesn't exist
//if (!is_dir($upload_dir)) {
//    mkdir($upload_dir, 0777);
//    chmod($upload_dir, 0777);
//}

//Check to see if any images with the same name already exist
if (file_exists($large_image_location)) {
    if (file_exists($thumb_image_location)) {
        $thumb_photo_exists = "<img src=\"" . $thumb_image_location . "\" alt=\"" . $user_id . "\"/>";
    } else {
        $thumb_photo_exists = "";
    }
    $large_photo_exists = "<img src=\"" . $large_image_location . "\" alt=\"" . $user_id . "\"/>";
} else {
    $large_photo_exists = "";
    $thumb_photo_exists = "";
}

if (isset($_POST["upload"])) {
    //Get the file information
    $userfile_name = $_FILES['image']['name'];
    $userfile_tmp = $_FILES['image']['tmp_name'];
    $userfile_size = $_FILES['image']['size'];
    $userfile_type = $_FILES['image']['type'];
    $filename = basename($_FILES['image']['name']);
    $file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));

    //Only process if the file is a JPG, PNG or GIF and below the allowed limit
    if ((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {

        foreach ($allowed_image_types as $mime_type => $ext) {
            //loop through the specified image types and if they match the extension then break out
            //everything is ok so go and check file size
            if ($file_ext == $ext && $userfile_type == $mime_type) {
                $error = "";
                break;
            } else {
                $error = "file_selected_supported_extension";
            }
        }
        //check if the file size is above the allowed limit
        if ($userfile_size > ($max_file * 1048576)) {
            $error= "exceeds_the_limit_file_size";
        }
    } else {
        $error = "there_are_no_files";
    }
    $messages->set_message('fail', $error);
    //Everything is ok, so we can upload the image.
    if (strlen($error) == 0) {

        if (isset($_FILES['image']['name'])) {

            move_uploaded_file($userfile_tmp, $large_image_location);
            chmod($large_image_location, 0777);

            $width = getWidth($large_image_location);
            $height = getHeight($large_image_location);
            //Scale the image if it is greater than the width set above
            if ($width > $max_width) {
                $scale = $max_width / $width;
                $uploaded = resizeImage($large_image_location, $width, $height, $scale);
            } else {
                $scale = 1;
                $uploaded = resizeImage($large_image_location, $width, $height, $scale);
            }
            //Delete the thumbnail file so the user can create a new one
            // if (file_exists($thumb_image_location)) {
            //     unlink($thumb_image_location);
            // }
            
        }
    }
}
if (isset($_POST['upload_thumbnail'])) {
    //Get the new coordinates to crop the image.
    $x1 = $_POST["x1"];
    $y1 = $_POST["y1"];
    $x2 = $_POST["x2"];
    $y2 = $_POST["y2"];
    $w = $_POST["w"];
    $h = $_POST["h"];
    //Scale the image to the thumb_width set above
    $scale = $thumb_width / $w;
    $cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
    $user->update_user_picture($user_id, $profile_image_name);
    if (file_exists($large_image_location)) {
        unlink($large_image_location);
    }
    //Reload the page again to view the thumbnail
    header("location:" . $_SERVER["PHP_SELF"]);
    exit();
}

$current_large_image_width = getWidth($large_image_location);
$current_large_image_height = getHeight($large_image_location);

$smarty->assign('user_id', $user_id);
$smarty->assign('uploaded', $uploaded);

$smarty->assign('thumb_width', $thumb_width);
$smarty->assign('thumb_height', $thumb_height);

$smarty->assign('current_large_image_width', $current_large_image_width);
$smarty->assign('current_large_image_height', $current_large_image_height);

$smarty->assign('large_image_name', $profile_large_image_name);
$smarty->assign('large_image', $large_image_location);
$smarty->assign('thumbnail_image', $thumb_image_location);

$smarty->assign('thumb_photo_exists', $thumb_photo_exists);

$smarty->assign('message', $messages->show_message());
$smarty->display('extends:layouts/dashboard.tpl|profile_photo.tpl');
?>