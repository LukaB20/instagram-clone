<?php 

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

@include("./models/User.php");
@include("./models/Post.php");
@include("./models/Following.php");

$currentUser = $_SESSION['user_id'];
$followers = Following::getFollowers();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram | Followers</title>
    <link rel="stylesheet" href="./style/sidebar.css">
    <link rel="stylesheet" href="./style/followers.css">
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

        <div class="friends-container">
            <div class="central-div">
                <h1>People following you</h1>
                <div class="friends">
                    <?php var_dump($followers) ?>
                    <?php foreach($followers as $follower){ ?>
                    <div class="friend">
                        <div class="user-info">
                            <div class="user-image" style="background-image: url(<?php echo $follower['image']; ?>);"></div>
                                <a href="" class="user-name"><?php echo $follower['firstname'] . " " . $follower['lastname']; ?></a>
                            </div>
                            <?php if(Following::isFollowing($follower['user_id'])) { ?>
                                <button class="unfollow" onclick="unFollowUser(<?php echo $follower['user_id'] ?>)" style="display: block;">Unfollow</button>
                                <button class="follow" onclick="followUser(<?php echo $follower['user_id'] ?>)" style="display: none;">Follow</button>
                            <?php }else{ ?>
                                <button class="unfollow" onclick="unFollowUser(<?php echo $follower['user_id'] ?>)" style="display: none;">Unfollow</button>
                                <button class="follow" onclick="followUser(<?php echo $follower['user_id'] ?>)" style="display: block;">Follow</button>
                            <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="./ajax/friends.js"></script>

</body>
</html>