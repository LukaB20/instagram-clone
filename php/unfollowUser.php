<?php

session_start();

$currentUser = $_SESSION['user_id'];
$friendId = $_GET['friendId'];

@require("database.php");

$statement = $conn->prepare("DELETE FROM following WHERE user_id = '$currentUser' and friend_id = '$friendId'");

try{
    $statement->execute();
}catch(PDOException $e){
    echo json_decode(0);
}

?>