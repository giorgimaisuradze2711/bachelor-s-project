<?php
session_start();

include "../class/database.php";

include "../class/commentModel.php";
include "../class/commentControl.php";
include "../class/commentView.php";

include "../class/postModel.php";
include "../class/postControl.php";
include "../class/postView.php";

include "../class/userModel.php";
include "../class/userView.php";

$postID = $_POST["postID"];
$userID = $_SESSION["user_id"];
$commenText = $_POST["commentText"];

$insertComment = new CommentControl(null, $postID, $userID, $commenText);
$insertComment -> setComment();

$updateCommentCount = new PostControl($postID, null, null, null, null);
$updateCommentCount -> increaseCommentCount();

$selectComments = new CommentView();
$comment = $selectComments -> getCommentsByDateDesc($postID, 0, 1);

$commentID = $comment[0]["comment_id"];
$commentAuthorID = $comment[0]["user_id"];
$commentText = $comment[0]["comment_text"];
$commentDate = $comment[0]["comment_date"];

$fetchCommentAuthor = new UserView();
$commentAuthor = $fetchCommentAuthor -> fetchUser($commentAuthorID);
$commentAuthorUsername = $commentAuthor[0]["username"];

include "../shared/comment.php";
