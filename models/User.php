<?php

/**
 * Summary of User
 */
class User{

    public static function insertUser($firstname, $lastname, $email, $password, $status, $image, $folder){

        @require("php/database.php");

        $statement = $conn->prepare("INSERT INTO user (firstname, lastname, email, password, status, image, folder)
                                    VALUES (:firstname, :lastname, :email, :password, :status, :image, :folder)");

        $statement->bindParam(":firstname", $firstname);
        $statement->bindParam(":lastname", $lastname);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":status", $status);
        $statement->bindParam(":image", $image);
        $statement->bindParam(":folder", $folder);

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

    public static function findUser($userID){

        @require("php/database.php");

        $statement = $conn->prepare("SELECT * FROM user WHERE user_id = '$userID'");

        try{    
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if($result != null){
                return $result;
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }

    }

    public static function getUserFolderName($userID){

        $conn = null;

        try{
            $conn = new PDO("mysql:host=localhost;dbname=instagram", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }

        $statement = $conn->prepare("SELECT * FROM user WHERE user_id = '$userID'");

        try{
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if($result != null){
                return $result['folder'];
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        
    }

    public static function getUserProfileImage($userID){

        $conn = null;

        try{
            $conn = new PDO("mysql:host=localhost;dbname=instagram", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }

        $statement = $conn->prepare("SELECT * FROM user WHERE user_id = '$userID'");

        try{
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if($result != null){
                return $result['image'];
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        
    }
    
    public static function getUserFullName($userID){

        $conn = null;

        try{
            $conn = new PDO("mysql:host=localhost;dbname=instagram", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }

        $statement = $conn->prepare("SELECT * FROM user WHERE user_id = '$userID'");

        try{
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if($result != null){
                return $result['firstname'] . " " . $result['lastname'];
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        
    } 

    public static function changeUserProfileImage($imageName){
        $conn = null;
        $currentUser = $_SESSION['user_id'];
        try{
            $conn = new PDO("mysql:host=localhost;dbname=instagram", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }

        $statement = $conn->prepare("UPDATE user SET image = '$imageName' WHERE user_id = '$currentUser'");

        try{
            $statement->execute();
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

}