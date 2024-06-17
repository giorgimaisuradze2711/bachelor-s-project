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
    <title>Change Password</title>
</head>
<body>
    <form action="/action/changePasswordAction.php" method="post">
        <label for="NewPassword">New Password</label>
        <input type="password" name="NewPassword" id="NewPassword">

        <label for="Password">Password</label>
        <input type="password" name="Password" id="Password">

        <input type="submit" value="Change Password" name="ChangePassword">
    </form>
</body>
</html>