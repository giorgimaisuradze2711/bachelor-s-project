<link rel="stylesheet" href="/css/post.css">
<div class="post" id="post<?php echo $postID ?>">

    <div class="user-container">
        <img src=<?php echo "../user/".$userID."/profileImage.png?a=".$time ?> alt="Profile Image">   
        <a href="/page/profile.php?user_id=<?php echo $userID?>"><?php echo $postAuthorUsername ?></a>
    </div>

    <?php
    if(!empty($postText)){
    ?>
        <div class="post-text">
            <pre><?php echo $post["post_text"]?></pre>
        </div>
    <?php
    }

    if(isset($postMedia)){
        if($postMediaFileType == "mp4" || $postMediaFileType == "ogg"){
    ?>
        <div class="post-media">
            <video src="<?php echo $postMedia?>" controls></video>
        </div>
    <?php
    } else {
    ?>
        <div class="post-media">
            <a target="_blank" href="<?php echo $postMedia ?>">
                <img src=<?php echo $postMedia ?>>
            </a>
        </div>
    <?php
        }
    }
    ?>

    <div class="post-button-container">

        <div>
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M4 21h1V8H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2zM20 8h-7l1.122-3.368A2 2 0 0 0 12.225 2H12L7 7.438V21h11l3.912-8.596L22 12v-2a2 2 0 0 0-2-2z"></path></svg>
                Like
            </button>
            <span id="likeCountContainer<?php echo $postID ?>">
                <?php
                    echo $post["like_count"]
                ?>
            </span>
        </div>

        <div>
            <button id="commentSectionButton<?php echo $postID ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zm-5 10.5A1.5 1.5 0 0 1 9.5 14c-.086 0-.168-.011-.25-.025-.083.01-.164.025-.25.025a2 2 0 1 1 2-2c0 .085-.015.167-.025.25.013.082.025.164.025.25zm4 1.5c-.086 0-.167-.015-.25-.025a1.471 1.471 0 0 1-.25.025 1.5 1.5 0 0 1-1.5-1.5c0-.085.012-.168.025-.25-.01-.083-.025-.164-.025-.25a2 2 0 1 1 2 2z"></path></svg>
                Comment
            </button>
            <span id="commentCountContainer<?php echo $postID ?>">
                <?php
                    echo $post["comment_count"]
                ?>
            </span>
        </div>

        <?php
        if($userID == $_SESSION["user_id"]){
        ?>
        <div class="delete-post-button-container">
            <button class="delete-post-button" id="deletePost">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z"></path></svg>
                Delete
            </button>
        </div>
        <?php
        }
        ?>
    </div>

    <div class="comment-section" id="commentSection<?php echo $postID ?>">
        <?php 
        include "commentForm.php";
        ?>

        <div class="comment-list"  id="commentList<?php echo $postID ?>">
        <?php
        $commentOffset = 0;
        $commentLimit = 2;
        $selectComments = new CommentView();
        $comment = $selectComments -> getCommentsByDateDesc($postID, $commentOffset, $commentLimit);

        foreach ($comment as $comment){

            $commentID = $comment["comment_id"];
            $commentAuthorID = $comment["user_id"];
            $commentText = $comment["comment_text"];

            $fetchCommentAuthor = new UserView();
            $commentAuthor = $fetchCommentAuthor -> fetchUser($commentAuthorID);
            $commentAuthorUsername = $commentAuthor[0]["username"];

            include "comment.php";
        }
        ?>
            <div>
                <?php
                if($post["comment_count"] > $commentLimit ){
                ?>
                    <button class="load-more-comments" id="showMoreComments<?php echo $postID ?>">Show More Comments</button>
                <?php
                } elseif($post["comment_count"] == 0) {
                ?>
                    <div id="noComment" class="no-comments">There Are No Comments, Be The First To Add One.</div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#commentSection<?php echo $postID ?>').toggle();
            $('#commentSectionButton<?php echo $postID ?>').click(function(){
                $('#commentSection<?php echo $postID ?>').toggle();
            });
        });
    </script>
</div>