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

}

?>