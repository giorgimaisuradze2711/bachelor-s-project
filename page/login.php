<?php
if(isset($_SESSION["user_id"])){
    header("Location: /index.php");
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/css/authentication.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <title>Log In</title>
</head>
<body>
    <div class="form-container">
        <form action="/action/loginAction.php" method="post">
            <label for="Email">Email</label>
            <input type="email" name="Email" id="Email">

            <label for="Password">Password</label>
            <input type="password" name="Password" id="Password">

            <a href="/action/forgotPasswordAction.php">Forgot Password?</a>

            <input type="submit" value="Log In" name="LogIn">
            <hr>
            <span>New Here? </span><a href="/page/signup.php">Sign Up</a>
        </form>
    </div>
</body>
</html>