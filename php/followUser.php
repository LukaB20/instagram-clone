<?php

session_start();

$currentUser = $_SESSION['user_id'];
$friendId = $_GET['friendId'];

@require("database.php");

$statement = $conn->prepare("INSERT INTO following (user_id, friend_id) VALUES ($currentUser, $friendId)");

try{
    $statement->execute();
}catch(PDOException $e){
    echo json_decode(0);
}

?>