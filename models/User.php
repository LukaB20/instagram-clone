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

    public static function authentificateUser($email, $password){
        
        @require_once("php/database.php");

        $statement = $conn->prepare("SELECT * FROM user WHERE email = '$email' and password = '$password'");

        try{
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if($result != null){
                return $result[0]['user_id'];
            }else{
                return null;
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return null;
        }

    }

}