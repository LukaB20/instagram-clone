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

    public static function getFollowers(){

        @require("./php/database.php");

        $currentUser = $_SESSION['user_id'];

        $statement = $conn->prepare("SELECT * FROM user WHERE user_id IN ( SELECT user_id FROM following WHERE friend_id = '$currentUser')");

        try{
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return array();
        }
    }

    public static function getFollowing(){
        @require("./php/database.php");

        $currentUser = $_SESSION['user_id'];

        $statement = $conn->prepare("SELECT u.*
        FROM user u
        INNER JOIN following f ON u.user_id = f.friend_id
        WHERE f.user_id = '$currentUser'");

        try{
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return array();
        }
    }

}

?>