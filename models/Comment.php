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

}


?>