<?php 

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
}

@require("models/Comment.php");
@require("models/User.php");
@require("models/Like.php");
@require("models/Post.php");

$comments = Comment::getComments($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/sidebar.css">
    <link rel="stylesheet" href="./style/post.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Instagram | Post</title>
</head>
<body>

    <div class="wrapper">
        <div class="side-bar">

            <h2><a href="home.php">Instagram</a></h2>
    
            <div class="link-group">
                <a href="home.php"><i class="fa-solid fa-house"></i> Home</a>
                <a href="home.html"><i class="fa-solid fa-message"></i> Messages</a>
                <a href="addPost.php"><i class="fa-solid fa-square-plus"></i> Add new post</a>
                <a href="search.php"><i class="fa-solid fa-magnifying-glass fa-rotate-90"></i> Search</a>
                <a href="profile.php?id=<?php echo $_SESSION['user_id'] ?>"><i class="fa-solid fa-user"></i> Profile</a>
            </div>
    
            <form action="./php/logout.php" method="post">
                <i class="fa-solid fa-right-from-bracket" style="margin-right: 1rem;"></i><input type="button" value="Log Out">
            </form>
    
        </div>
    
        <div class="post-container">
            <div class="post row">
                <div class="image col-xxl-6 col-xl-12">
                </div>
                <div class="image-statistics col-xxl-6 col-xl-12">
                    <div class="post-info">
                        <div class="user">
                            <div class="user-image" style="background-image: url(<?php echo User::getUserProfileImage(Post::getUsersId($_GET['id'])); ?>)"></div>
                            <p class="user-name">Luka Banovic</p>
                        </div>
                        <p class="post-description">
                            Ovo je opis ove objave
                        </p>
                        <div class="post-info-flex">
                            <?php if(Like::isLiked($_GET['id'])) { ?>
                                <button class="like-btn" id="like-btn" style="display: none;" onclick="likePost(<?php echo $_GET['id']; ?>)"><i class="fa-regular fa-heart"></i></button>
                                <button class="like-btn" id="dislike-btn" onclick="dislikePost(<?php echo $_GET['id']; ?>)"><i class="fa-solid fa-heart dislike-btn"></i></button>
                            <?php }else{ ?>
                                <button class="like-btn" id="like-btn" onclick="likePost(<?php echo $_GET['id']; ?>)"><i class="fa-regular fa-heart"></i></button>
                                <button class="like-btn" id="dislike-btn" style="display: none;" onclick="dislikePost(<?php echo $_GET['id']; ?>)"><i class="fa-solid fa-heart dislike-btn"></i></button>
                            <?php } ?>
                            <p><span id="no-of-likes"><?php echo Like::getNumberOfLikes($_GET['id']); ?></span> likes</p>
                            <p><span id="no-of-comments"><?php echo Comment::getNumberOfComments($_GET['id']); ?></span> comments</p>
                        </div>
                        <div class="comments">
                            <?php foreach($comments as $comment) { ?>
                                <div class="comment">
                                <div class="user-comment-image" style="background-image: url(<?php echo User::getUserProfileImage($comment['user_id']); ?>)"></div>
                                    <div class="name-comment">
                                        <a href="#" class="comment-name"><?php echo User::getUserFullName($comment['user_id']); ?></a>
                                        <p class="comment-text"><?php echo $comment['comment_text']; ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="post-comment">
                        <input type="text" name="postId" id="postId" value="<?php echo $_GET['id']; ?>" hidden>
                        <input type="text" name="commentText" id="commentText">
                        <input type="button" onclick="createPost()" value="Post" id="postComment">
                    </div>
            </div>
        </div>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="./ajax/post.js"></script>
</body>
</html>