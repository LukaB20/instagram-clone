<?php

session_start();

@require("../models/Comment.php");
@require("../models/User.php");

Comment::createComment($_SESSION['user_id'], $_POST["postId"], $_POST['commentText']);

$userData = User::findUser($_SESSION['user_id']);

echo json_encode($userData);


?>