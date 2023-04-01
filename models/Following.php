<?php

session_start();


class Following{

    public static function isFollowing($friendId){
        @require("./php/database.php");

        $currentUser = $_SESSION['user_id'];

        $statement = $conn->prepare("SELECT * FROM following WHERE user_id = '$currentUser' and friend_id = '$friendId'");

        try{
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if($result != null){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo "Error: " . $e;
            return false;
        }

    }

    public static function getNumberOfFollowers($userId){
        @require("./php/database.php");

        $statement = $conn->prepare("SELECT * FROM following WHERE friend_id = '$userId'");

        try{
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            exit();
        }
    }

    public static function getNumberOfFollowing($userId){
        @require("./php/database.php");

        $statement = $conn->prepare("SELECT * FROM following WHERE user_id = '$userId'");

        try{
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            exit();
        }
    }

}

?>