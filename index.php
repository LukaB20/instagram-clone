<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style/loginRegister.css">
    <title>Instagram | Login</title>
</head>
<body>

    <div class="container">
        <h1>Instagram</h1>

        <p class="error-text">Invalid email or password</p>

        <form action="#">
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <input type="submit" value="Log In">
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
    
</body>
</html>