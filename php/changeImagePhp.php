<?php

session_start();

@include("../models/User.php");
@include("../models/Post.php");

$allowedExtensions = array("png", "jpg", "jpeg");

$userId = $_SESSION['user_id'];
$imageName = $_FILES['image']['name'];
$imageExtension = strtolower(explode(".", $imageName)[1]);

$folderName = User::getUserFolderName($userId);

if(!in_array($imageExtension, $allowedExtensions)){
    header("Location: ../changeImage.php?error='Invalid image type.'");
    exit();
}else{
    $target =  "../uploads/" . $folderName . "/profile_image" . "/" . $imageName;

    if(!move_uploaded_file($_FILES['image']['tmp_name'], $target)){
        header("Location: ../changeImage.php?error='Failed to upload a file to folder'");
        exit();
    }else{
        User::changeUserProfileImage("uploads/" . $folderName . "/profile_image" . "/" . $imageName);
        header("Location: ../profile.php?id=$userId");
    }
}


?>