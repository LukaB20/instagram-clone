<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>

    <div class="side-bar">

        <h2><a href="home.html">Instagram</a></h2>

        <div class="link-group">
            <a href="home.html"><i class="fa-solid fa-house"></i> Home</a>
            <a href="home.html"><i class="fa-solid fa-message"></i> Messages</a>
            <a href="home.html"><i class="fa-solid fa-square-plus"></i> Add new post</a>
            <a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a>
        </div>

        <form action="./php/logout.php" method="post">
            <i class="fa-solid fa-right-from-bracket" style="margin-right: 1rem;"></i><input type="button" value="Log Out">
        </form>

    </div>
    
</body>
</html>