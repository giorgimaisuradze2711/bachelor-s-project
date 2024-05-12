<?php

    session_start();

    include "../class/database.php";

    include "../class/likeModel.php";
    include "../class/likeControl.php";

    include "../class/postModel.php";
    include "../class/postControl.php";

    $userID = $_SESSION["UserID"];
    $postID = $_POST["postID"];

    $updateLike = new LikeControl($userID, $postID);
    $updateLikeCount = new PostControl($postID, NULL, NULL, NULL);

    if(isset($_POST["addLike"])){

        $updateLike = new LikeControl($userID, $postID);
        $updateLikeCount = new PostControl($postID, NULL, NULL, NULL);

        $updateLike -> setInsertLike($userID, $postID);
        $updateLikeCount -> increaseLikeCount($postID);

        header("location: ../index.php");

    } elseif (isset($_POST["deleteLike"])){

        $updateLike -> setDeleteLike($userID, $postID);
        $updateLikeCount -> decreaseLikeCount($postID);

        header("location: ../index.php");

    } else {

        header("location: ../index.php");

    }

?>