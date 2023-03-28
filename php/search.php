<?php

session_start();

$currentUser = $_SESSION['user_id'];
$searchString =  $_GET['searchTxt'];
$suggestedFriends = array();

@require("database.php");

if(empty($searchString)){
    echo json_encode(array());
}

if(str_contains($searchString, " ")){
    $firstName = explode(" ", $searchString)[0];
    $lastName = explode(" ", $searchString)[1];
    $statement = $conn->prepare("SELECT * FROM user
    WHERE (firstname LIKE '%$firstName%' OR lastname LIKE '%$lastName%')
    AND
    user_id <> '$currentUser'
    ");
}else{
    $statement = $conn->prepare("SELECT * FROM user
    WHERE (firstname LIKE '%$searchString%' OR lastname LIKE '%$searchString%')
    AND
    user_id <> '$currentUser'
    ");
}

try{
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($users as $user){
        array_push($suggestedFriends, $user);
    }
    echo json_encode($users);
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    exit();
}


?>