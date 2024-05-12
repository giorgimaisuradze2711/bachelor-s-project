<?php

    session_start();

    include "../class/database.php";

    include "../class/commentModel.php";
    include "../class/commentControl.php";

    include "../class/postModel.php";
    include "../class/postControl.php";

    if(isset($_POST["addComment"])){

        $postID = $_POST["postID"];
        $userID = $_SESSION["UserID"];
        $commenText = $_POST["commentText"];

        $insertComment = new CommentControl(null, $postID, $userID, $commenText);
        $insertComment -> setInsertComment();

        $updateCommentCount = new PostControl($postID, null, null, null);
        $updateCommentCount -> increaseCommentCount();

        header("location: ../index.php");

    } else if(isset($_POST["deleteComment"])){

        $commentID = $_POST["commentID"];
        $postID = $_POST["postID"];

        $deleteComment = new CommentControl($commentID, null, null, null);
        $deleteComment -> setDeleteComment();

        $updateCommentCount = new PostControl($postID, null, null, null);
        $updateCommentCount -> decreaseCommentCount();

        header("location: ../index.php");

    } else {

        header("location: ../index.php");

    }