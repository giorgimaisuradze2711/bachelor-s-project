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
    <title>Change Email</title>
</head>
<body>
    <form action="/action/changeEmailAction.php" method="post">
        <label for="Email">Email</label>
        <input type="text" name="Email" id="Email">

        <label for="Password">Password</label>
        <input type="password" name="Password" id="Password">

        <input type="submit" value="Change Email" name="ChangeEmail">
    </form>
</body>
</html>