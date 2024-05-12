<?php
if(isset($_POST["post"])){
    session_start();

    include "../class/database.php";

    include "../class/postModel.php";
    include "../class/postControl.php";
    include "../class/postView.php";

    $userID = $_SESSION["user_id"];
    $postText = $_POST["postText"];
    $postMedia = $_FILES["postMedia"];

    $insertPost = new PostControl(null, $userID, $postText, $postMedia);
    $insertPost -> setPost();

    if(!empty($postMedia["name"])){

        $selectPost = new PostView();
        $post = $selectPost -> getUserPost($userID, 0, 1);

        $postID = $post[0]["post_id"];

        mkdir("../user/" . $_SESSION["UserID"] . "/post/" . $postID, 0777, true);

        $postMediaFileType = strtolower(pathinfo($postMedia["name"],PATHINFO_EXTENSION));
        $postMediaFilePath = "../user/" . $_SESSION["user_id"] . "/post/" . $postID . "/1." . $postMediaFileType;

        move_uploaded_file($postMedia["tmp_name"], $postMediaFilePath);
    }
}
header("location: /index.php");