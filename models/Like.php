<?php

session_start();

class Like {

    public static function likePost($post_id){
        @require("../php/database.php");
        $current_user = $_SESSION['user_id'];
        $statement = $conn->prepare("INSERT INTO liked (user_id, post_id) VALUES ($current_user, $post_id);");

        try{
            $statement->execute();
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            exit();
        }
    }

    public static function unlikePost($post_id){
        @require("../php/database.php");
        $current_user = $_SESSION['user_id'];
        $statement = $conn->prepare("DELETE FROM liked WHERE user_id = $current_user and post_id = $post_id");

        try{
            $statement->execute();
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            exit();
        }
    }

    public static function isLiked($post_id){
        @require("../php/database.php");
        $current_user = $_SESSION['user_id'];
        $statement = $conn->prepare("SELECT * FROM liked WHERE user_id = $current_user and post_id = $post_id");

        try{
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if($result != null){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

}

?>