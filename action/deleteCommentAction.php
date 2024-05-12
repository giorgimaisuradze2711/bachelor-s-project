<?php

include "../class/database.php";

include "../class/commentModel.php";
include "../class/commentControl.php";

include "../class/postModel.php";
include "../class/postControl.php";
include "../class/postView.php";

$commentID = $_POST["commentID"];
$postID = $_POST["postID"];

$deleteComment = new CommentControl($commentID, null, null, null);
$deleteComment -> setDeleteComment();

$updateCommentCount = new PostControl($postID, null, null, null);
$updateCommentCount -> decreaseCommentCount();

?>