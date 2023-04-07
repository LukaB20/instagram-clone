<?php

session_start();

@require("../models/Comment.php");

$queryResult = Comment::createComment($_SESSION['user_id'], $_POST["postId"], $_POST['commentText']);

return json_encode($queryResult);

?>