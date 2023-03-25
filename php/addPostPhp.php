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
    header("Location: ../addPost.php?error='Invalid image type.'");
    exit();
}

if(Post::createPost($imageName, $_POST['description'])){

    $target =  "../uploads/" . $folderName . "/posts" . "/" . $imageName;

    if(!move_uploaded_file($_FILES['image']['tmp_name'], $target)){
        header("Location: ../addPost.php?error='Failed to upload a file to folder'");
        exit();
    }else{
        header("Location: ../profile.php");
    }

}else{
    header("Location: ../addPost.php?error='Failed to upload a file.'");
    exit();
}



?>