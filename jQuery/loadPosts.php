<?php
session_start();
$time = date("H:i:s");

include "../class/database.php";

include "../class/postModel.php";
include "../class/postView.php";

include "../class/userModel.php";
include "../class/userView.php";

include "../class/commentModel.php";
include "../class/commentView.php";

include "../class/likeModel.php";
include "../class/likeView.php";

$postLimit = $_POST["postLimit"];
$postOffset = $_POST["postOffset"];

$selectPost = new PostView();
$posts = $selectPost -> getPost($postOffset, $postLimit);
$postCount = $selectPost -> getPostCount();

foreach ($posts as $post){

    $postID = $post["post_id"];
    $userID = $post["user_id"];
    $postText = $post["post_text"];
    $postMedia = $post["post_media"];
    
    $fecthPostAuthor = new UserView();
    $postAuthor = $fecthPostAuthor -> fetchUser($userID);
    $postAuthorUsername = $postAuthor[0]["username"];

    if(isset($postMedia)){
        $postMediaFileType = strtolower(pathinfo($postMedia,PATHINFO_EXTENSION));
    }

    include "../shared/post.php";
}