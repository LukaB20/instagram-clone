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

$numberOfFollowers = count(Following::getNumberOfFollowers($_GET['id']));
$numberOfFollowing = count(Following::getNumberOfFollowing($_GET['id']));

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
                            <a href="changeImage.php">Change profile image</a>
                        <?php }else{?>
                            <?php if(Following::isFollowing($_GET['id'])){ ?>
                                <button id="unfollow-user" style="display:block" onclick="unfollowUser(<?php echo $_GET['id'] ?>)">Unfollow</button>
                                <button id="follow-user" style="display:none" onclick="followUser(<?php echo $_GET['id'] ?>)">Follow</button>
                            <?php }else{?>
                                <button id="follow-user" style="display:block" onclick="followUser(<?php echo $_GET['id'] ?>)">Follow</button>
                                <button id="unfollow-user" style="display:none" onclick="unfollowUser(<?php echo $_GET['id'] ?>)">Unfollow</button>
                            <?php }?>
                        <?php } ?>
                        
                    </div>
    
                    <div class="user-stats">
                        <p><span><?php echo $userPostsCount; ?></span> posts</p>
                        <p><a href="followers.php"><span><?php echo $numberOfFollowers; ?></span> followers</a></p>
                        <p><a href="following.php"><span><?php echo $numberOfFollowing ?></span> following</a></p>
                    </div>
                </div>

            </div>

            <div class="user-posts">
                <?php foreach($userPosts as $post){ 
                    $userPostPath = $userFolderName . $post['imageUrl'];    
                ?>
                    <div class='post' style="background-image: url(<?php echo $userPostPath; ?>);">
                        <div class="inner-post">
                            <p>0 <i class="fa-solid fa-heart"></i> 0 <i class="fa-solid fa-comment"></i></p>
                            <a href="post.php?id=<?php echo $post['post_id'] ?>">View post</a>
                        </div>
                    </div>
                <?php } ?> 
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="./ajax/profile.js"></script>

</body>
</html>