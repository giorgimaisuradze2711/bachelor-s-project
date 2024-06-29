<?php

session_start();

include "../class/database.php";

include "../class/userModel.php";
include "../class/userView.php";

include "../class/commentModel.php";
include "../class/commentView.php";

include "../class/postModel.php";
include "../class/postView.php";

$commentOffset = $_POST["commentOffset"];
$commentLimit = $_POST["commentLimit"];
$postID = $_POST["postID"];

$selectComments = new CommentView();
$comment = $selectComments -> getCommentsByDateDesc($postID, $commentOffset, $commentLimit);

foreach ($comment as $comment){

    $commentID = $comment["comment_id"];
    $commentAuthorID = $comment["user_id"];
    $commentText = $comment["comment_text"];

    $fetchCommentAuthor = new UserView();
    $commentAuthor = $fetchCommentAuthor -> fetchUser($commentAuthorID);
    $commentAuthorUsername = $commentAuthor[0]["username"];
    
    include "../shared/comment.php";
}
?>