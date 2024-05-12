<?php
    session_start();
    $time = date("H:i:s");
    if(!isset($_SESSION["user_id"])){
        header("location: /page/login.php");
    } else {
        null;
    }

    include "class/database.php";

    include "class/postModel.php";
    include "class/postView.php";

    include "class/userModel.php";
    include "class/userView.php";

    // include "class/commentModel.php";
    // include "class/commentView.php";

    // include "class/likeModel.php";
    // include "class/likeView.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="ghostling">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-3.6.0.min.js"></script>
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="postForm.css">
    <link rel="stylesheet" href="post.css">
    <title>Ghostling</title>
</head>

<body>
    <?php
        include "shared/header.php";
        include "shared/footer.php";
        include "shared/postForm.php";
    ?>

    <div id="postContainer">
        <?php
        $postLimit = 5;
        $postOffset = 0;
        
        $selectPost = new PostView();
        $posts = $selectPost -> getPost($postOffset, $postLimit);
        $postCount = $selectPost -> getPostCount();
        ?>
        <script>
            $(document).ready(function(){
                var postLimit = 5;
                var postOffset = 0;

                $("#showMorePosts").click(function(){
                    postLimit = postLimit;
                    postOffset = postOffset + 5;
                    
                    $.post("action/loadPostsAction.php",
                    {
                        postLimit: postLimit,
                        postOffset: postOffset,
                    },

                    function(data){
                        $("#postContainer").append(data);
                        if(postOffset + 5 >= <?php echo count($postCount); ?>){
                            $("body").append($('<div class = "no-posts">No More Posts, You Hit The End!</div>'));
                            $("#showMorePosts").remove();
                        };
                    });
                });
            });
        </script>
        
        <?php
        foreach ($posts as $post){

            $postID = $post["post_id"];
            $userID = $post["user_id"];
            $postText = $post["post_text"];

            $fecthPostAuthor = new UserView();
            $postAuthor = $fecthPostAuthor -> fetchUser($userID);
            $postAuthorUsername = $postAuthor[0]["username"];

            $postMediaPath = "user/" . $userID . "/post/" . $postID . "/1*";
            $postMedia = glob($postMediaPath);

            if(isset($postMedia[0])){
                $postMediaFileType = strtolower(pathinfo($postMedia[0],PATHINFO_EXTENSION));
            }

            include "shared/post.php";

        }
        ?>

    </div>
    
    <?php
    if($postOffset + 5  <= count($posts)){
    ?>
        <button id="showMorePosts">Load More Posts</button>
    <?php

        } else {
    ?>
        <div class = "no-posts"> No More Posts, You Hit The End!</div>
    <?php
        }
    ?>
</body>
</html>