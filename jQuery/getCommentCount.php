<?php

include "../class/database.php";

include "../class/postModel.php";
include "../class/postControl.php";
include "../class/postView.php";

$postID = $_POST["postID"];

$selectPost = new PostView();
$currentPost = $selectPost -> getPostByID($postID);
$commentCount = $currentPost[0]["comment_count"];

echo $commentCount;