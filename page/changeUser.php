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
    <link rel="stylesheet" href="/css/authentication.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <title>Change User Name</title>
</head>
<body>
    <form action="/action/changeUserAction.php" method="post">
        <label for="Username">Username</label>
        <input type="text" name="Username" id="Username">

        <label for="Password">Password</label>
        <input type="password" name="Password" id="Password">

        <input type="submit" value="Change Username" name="ChangeUsername">
    </form>
</body>
</html>