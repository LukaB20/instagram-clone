<?php

/**
 * Summary of User
 */
class User{
    
    public static function insertUser($firstname, $lastname, $email, $password, $status, $image){

        @require("php/database.php");

        $statement = $conn->prepare("INSERT INTO user (firstname, lastname, email, password, status, image)
                                    VALUES (:firstname, :lastname, :email, :password, :status, :image)");

        $statement->bindParam(":firstname", $firstname);
        $statement->bindParam(":lastname", $lastname);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":status", $status);
        $statement->bindParam(":image", $image);

        try{
            $statement->execute();
            $conn = null;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

}