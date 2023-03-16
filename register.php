<?php
    
        $emailError = $confirmedPasswordError = $imageError = "";
        $allowedExtensions = array("png", "img", "png", "jpg", "jpeg");
        $success = "";

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                $emailError = "Invalid email format.";
            }
            if($_POST['password'] != $_POST['confirmPassword']){
                $confirmedPasswordError = "Passwords do not match.";
            }
            if($_FILES['image']['size'] > 10000000){
                $imageError = "Image size is large.";
            }else{
    
                $imageExtension = strtolower(explode(".", $_FILES['image']['name'])[1]);
    
                if(!in_array($imageExtension, $allowedExtensions)){
                    $imageError = "Invalid image type.";
                }
            }
            if(empty($emailError) && empty($confirmedPasswordError) && empty($imageError)){
    
                @require("./models/User.php");

                $success = "block";
                $userDirName = $_POST["firstName"] . time();
                mkdir("uploads/$userDirName");
                $targetFile = "uploads/" . $userDirName . "/" . $_FILES['image']['name'];
                if(!move_uploaded_file($_FILES['image']["tmp_name"], $targetFile)){
                    $imageError = "Image not uploaded.";
                    exit();
                }

                $fileName = $_FILES['image']['name'];

                $imagePath = "uploads/$userDirName/" . $fileName;

                User::insertUser($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'], "Offline", $imagePath);
            }
        }
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style/loginRegister.css">
    <title>Instagram | Register</title>
</head>
<body>

    <div class="container">
        <h1>Instagram</h1>

        <p class="error-text">Invalid email or password</p>
        <p class="success-text" style="display: <?php echo $success; ?>">You have successfully created an account. <a href="index.php">Login</a></p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])  ?>" method="POST" enctype="multipart/form-data">
            <div>
                <label for="firstName">First name</label>
                <input type="text" name="firstName" id="firstName" required>
            </div>
            <div>
                <label for="lastName">Last name</label>
                <input type="text" name="lastName" id="lastName" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required>
                <p class="invalid-field"><?php echo $emailError; ?></p>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <label for="confirmPassword">Confirm password</label>
                <input type="password" name="confirmPassword" id="confirmPassword" required>
                <p class="invalid-field"><?php echo $confirmedPasswordError; ?></p>
            </div>
            <div>
                <label for="image">Choose profile picture</label>
                <input type="file" name="image" id="image" required>
                <p class="invalid-field"><?php echo $imageError; ?></p>
            </div>
            <input type="submit" value="Sign Up">
        </form>
        <p>Already have an account? <a href="#">Login here</a></p>
    </div>
    
    <script src="./ajax/register_ajax.js"></script>
</body>
</html>