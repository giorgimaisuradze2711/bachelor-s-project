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

    $fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $userID = $_GET["user_id"];

    $userData = new UserView();
    $user = $userData->fetchUser($_SESSION["user_id"]);

    $profileUserData = new UserView();
    $profileUser = $userData->fetchUser($userID);

    if(!isset($_SESSION["user_id"])){
        header("location: login.php");
    }elseif (!isset($userID)){
        header("location: profile.php?user_id=".$_SESSION["user_id"]);
    } elseif (!isset($user[0])){
        die("USER DOESN'T EXSIST!");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/jQuery/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/style.css">
    <title><?php echo $profileUser[0]["username"] ?></title>
</head>

<body>
    <?php
        include "../shared/header.php";
        include "../shared/footer.php";
    ?>

    <script>
        $(document).ready(function(){
            $("#profileBanner").change(function(){
                $("#profileBannerForm").submit();
            });

            $("#profileImage").change(function(){
                $("#profileImageForm").submit();
            });  
        });
    </script>

    <div id="profile" class = "profile">
        <div class="profile-banner-container">
            <img class="profile-banner" src="<?php echo "../user/".$userID."/profileBanner.png?a=".date("H:i:s"); ?>" alt="Profile Header">
            
            <?php
            if($_GET["user_id"] == $_SESSION["user_id"]){
            ?>

            <label class="profile-banner-label" for="profileBanner">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M4 5h13v7h2V5c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h8v-2H4V5z"/><path d="m8 11-3 4h11l-4-6-3 4z"/><path d="M19 14h-2v3h-3v2h3v3h2v-3h3v-2h-3z"/></svg>
            </label>

            <form id="profileBannerForm"  hidden action="../action/changeProfileBannerAction.php" method="post" enctype="multipart/form-data">
                <input type="file" name="profileBanner" id="profileBanner">
            </form>

            <?php
            }
            ?>
        </div>

        <div class="user-info-container">
            <div class="profile-image-container">
                <img class="profile-image" src="<?php echo "../user/".$userID."/profileImage.png?a=".date("H:i:s"); ?>" alt="Profile Image">
                
                <?php
                if($_GET["user_id"] == $_SESSION["user_id"]){
                ?>

                <label class="profile-image-label" for="profileImage">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M4 5h13v7h2V5c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h8v-2H4V5z"/><path d="m8 11-3 4h11l-4-6-3 4z"/><path d="M19 14h-2v3h-3v2h3v3h2v-3h3v-2h-3z"/></svg>
                </label>

                <form id="profileImageForm" hidden action="../action/changeProfileImageAction.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="profileImage" id="profileImage">
                </form>

                <?php
                }
                ?>
            </div>

            <h1><?php echo $profileUser[0]["username"] ?></h1>

            <?php
            if($_GET["user_id"] == $_SESSION["user_id"]){
            ?>
                <div class="dropdown">
                    <button class="dropbtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="m2.344 15.271 2 3.46a1 1 0 0 0 1.366.365l1.396-.806c.58.457 1.221.832 1.895 1.112V21a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-1.598a8.094 8.094 0 0 0 1.895-1.112l1.396.806c.477.275 1.091.11 1.366-.365l2-3.46a1.004 1.004 0 0 0-.365-1.366l-1.372-.793a7.683 7.683 0 0 0-.002-2.224l1.372-.793c.476-.275.641-.89.365-1.366l-2-3.46a1 1 0 0 0-1.366-.365l-1.396.806A8.034 8.034 0 0 0 15 4.598V3a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v1.598A8.094 8.094 0 0 0 7.105 5.71L5.71 4.904a.999.999 0 0 0-1.366.365l-2 3.46a1.004 1.004 0 0 0 .365 1.366l1.372.793a7.683 7.683 0 0 0 0 2.224l-1.372.793c-.476.275-.641.89-.365 1.366zM12 8c2.206 0 4 1.794 4 4s-1.794 4-4 4-4-1.794-4-4 1.794-4 4-4z"></path></svg>
                    </button>
                    <div class="dropdown-content">
                        <a href="/page/changeUser.php">Change Username</a>
                        <a href="/page/changePassword.php">Change Password</a>
                        <a href="/page/changeEmail.php">Change Email</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <h1 class="title">User Posts</h1>

    <div class="post-container" id="postContainer">
        <?php
        $postLimit = 5;
        $postOffset = 0;
        
        $selectPost = new PostView();
        $posts = $selectPost -> getUserPost($userID, $postOffset, $postLimit);
        $postCount = $selectPost -> getPostCount();
        ?>
        
        <?php
        foreach ($posts as $post){

            $postID = $post["post_id"];
            $postText = $post["post_text"];
            $postMedia = $post["post_media"];
            $commentsCount = $post["comment_count"];

            $fecthPostAuthor = new UserView();
            $postAuthor = $fecthPostAuthor -> fetchUser($userID);
            $postAuthorUsername = $postAuthor[0]["username"];

            if(isset($postMedia)){
                $postMediaFileType = strtolower(pathinfo($postMedia,PATHINFO_EXTENSION));
            }

            include "../shared/post.php";
        }
        ?>
        <script>
            $(document).ready(function(){
                var postLimit = 5;
                var postOffset = 0;

                $("#showMorePosts").click(function(){
                    postLimit = postLimit;
                    postOffset = postOffset + 5;
                    
                    $.post("/jQuery/loadUserPosts.php",
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

        </div>
        
        <?php
        if($postOffset + 5  <= count($posts)){
        ?>
            <button id="showMorePosts" class="load-more-posts">Load More Posts</button>
        <?php

            } else {
        ?>
            <div class = "no-posts"> No More Posts, You Hit The End!</div>
        <?php
            }
        ?>
</body>
</html>