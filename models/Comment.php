<?php

class Comment{

    public static function createComment($user_id, $post_id, $comment_text){

        @require("../php/database.php");

        $statement = $conn->prepare("INSERT INTO comment (user_id, post_id, comment_text)
                                    VALUES(:userId, :postId, :commentText);
                                    ");

        $statement->bindParam(":userId", $user_id);
        $statement->bindParam(":postId", $post_id);
        $statement->bindParam(":commentText", $comment_text);

        try{
            $statement->execute();
            return true;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }

    }

    public static function getComments($post_id){

        @require("./php/database.php");

        $statement = $conn->prepare("SELECT * FROM comment WHERE post_id = $post_id");

        try{
            $statement->execute();
            $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $comments;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return;
        }

    }

}


?>