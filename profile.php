<?php 

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram</title>
    <link rel="stylesheet" href="./style/sidebar.css">
    <link rel="stylesheet" href="./style/userprofile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="container">
        <div class="side-bar">

            <h2><a href="home.html">Instagram</a></h2>
    
            <div class="link-group">
                <a href="home.html"><i class="fa-solid fa-house"></i> Home</a>
                <a href="home.html"><i class="fa-solid fa-message"></i> Messages</a>
                <a href="home.html"><i class="fa-solid fa-square-plus"></i> Add new post</a>
                <a href="profile.html"><i class="fa-solid fa-user"></i> Profile</a>
            </div>
    
            <form action="./php/logout.php" method="POST">
                <i class="fa-solid fa-right-from-bracket" style="margin-right: 1rem;"></i><input type="submit" value="Log Out">
            </form>
    
        </div>
        
        <div class="user-profile">
            
            <div class="user-info">

                <div class="user-image">
                </div>

                <div>
                    <div class="user-data">
                        <p class="name">Luka Banovic</p>
                        <a href="edit.html">Edit profile</a>
                    </div>
    
                    <div class="user-stats">
                        <p><span>4</span> posts</p>
                        <p><span>337</span> followers</p>
                        <p><span>237</span> following</p>
                    </div>
                </div>

            </div>

            <div class="user-posts">
                <div class="post">

                </div>
            </div>

        </div>
    </div>

</body>
</html>