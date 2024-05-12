<?php

include "../class/database.php";

include "../class/postModel.php";
include "../class/postControl.php";
include "../class/postView.php";

$postID = $_POST["postID"];

$selectPost = new PostView();
$currentPost = $selectPost -> getPostsByID($postID);
$commentCount = $currentPost[0]["Comments"];

echo $commentCount;
 
?>