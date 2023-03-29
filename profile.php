<?php 

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

@include("./models/User.php");
@include("./models/Post.php");
@include("./models/Following.php");

$user = User::findUser($_GET['id']);
$userPosts = Post::getUserPosts($_GET['id']);
$userFolderName = "./uploads" . "/" . User::getUserFolderName($_GET['id']) . "/" . "posts/";
$userPostsCount = count($userPosts);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram | Profile</title>
    <link rel="stylesheet" href="./style/sidebar.css">
    <link rel="stylesheet" href="./style/userprofile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="container">
        <div class="side-bar">

            <h2><a href="home.php">Instagram</a></h2>
    
            <div class="link-group">
                <a href="home.php"><i class="fa-solid fa-house"></i> Home</a>
                <a href="home.html"><i class="fa-solid fa-message"></i> Messages</a>
                <a href="addPost.php"><i class="fa-solid fa-square-plus"></i> Add new post</a>
                <a href="search.php"><i class="fa-solid fa-magnifying-glass fa-rotate-90"></i> Search</a>
                <a href="profile.php?id=<?php echo $_SESSION['user_id'] ?>"><i class="fa-solid fa-user"></i> Profile</a>
            </div>
    
            <form action="./php/logout.php" method="POST">
                <i class="fa-solid fa-right-from-bracket" style="margin-right: 1rem;"></i><input type="submit" value="Log Out">
            </form>
    
        </div>
        
        <div class="user-profile">
            
            <div class="user-info">

                <div class="user-image" style="background-image: url(<?php echo $user['image'] ?>)">
                </div>

                <div>
                    <div class="user-data">
                        <p class="name"><?php echo $user['firstname'] . " " . $user['lastname'] ?></p>
                        <?php if($_SESSION['user_id'] == $_GET['id']){ ?>
                            <a href="edit.html">Edit profile</a>
                        <?php }else{?>
                            <?php if(Following::isFollowing($_GET['id'])){ ?>
                                <button id="unfollow-user" onclick="unfollowUser(<?php echo $_GET['id'] ?>)">Unfollow</button>
                            <?php }else{?>
                                <button id="follow-user" onclick="followUser(<?php echo $_GET['id'] ?>)">Follow</button>
                            <?php }?>
                        <?php } ?>
                        
                    </div>
    
                    <div class="user-stats">
                        <p><span><?php echo $userPostsCount; ?></span> posts</p>
                        <p><span>337</span> followers</p>
                        <p><span>237</span> following</p>
                    </div>
                </div>

            </div>

            <div class="user-posts">
                <?php foreach($userPosts as $post){ 
                    $userPostPath = $userFolderName . $post['imageUrl'];    
                ?>
                    <div class='post' style="background-image: url(<?php echo $userPostPath; ?>);"></div>
                <?php } ?>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="./ajax/profile.js"></script>

</body>
</html>