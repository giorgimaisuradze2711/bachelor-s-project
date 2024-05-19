<?php
if (isset($_SESSION["UserID"])) {
    header("Location: /index.php");
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/jQuery/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/css/authentication.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <title>Sign Up</title>
</head>
<body>
    <div class="form-container">
        <form action="/action/signupAction.php" method="post">
            <label for="Username">Username</label>
            <input type="text" name="Username" id="Username">

            <label for="Email">Email</label>
            <input type="email" name="Email" id="Email">

            <label for="Password">Password</label>
            <input type="password" name="Password" id="Password">

            <label for="RepeatPassword">Repeat Password</label>
            <input type="password" name="RepeatPassword" id="RepeatPassword">

            <input type="submit" value="Sign Up" name="SignUp">
            <hr>
            <span>Already have an account? </span><a href="/page/login.php">Log In</a>
        </form>
    </div>
</body>
</html>