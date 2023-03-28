<?php

session_start();

class Post{

    public static function createPost($imageName, $description){

        @require("../php/database.php");

        $statement = $conn->prepare("INSERT INTO post (userPosted_id, imageUrl, datePosted, description)
                                    VALUES (:userId, :imageName, :dateP, :postDescription);
                                    ");

        $datep = date("d.m.Y", time());
        $statement->bindParam(":userId", $_SESSION['user_id']);
        $statement->bindParam(":imageName", $imageName);
        $statement->bindParam(":dateP", $datep);
        $statement->bindParam(":postDescription", $description);

        try{
            $statement->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }

    }

    public static function getUserPosts($userID){
        $posts = array();

        @require("./php/database.php");

        $statement = $conn->prepare("SELECT * FROM post WHERE userPosted_id = '$userID'");

        try{
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $post){
                array_push($posts, $post);
            }
            return $posts;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            exit();
        }
    }

}

?>