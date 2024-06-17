<link rel="stylesheet" href="/css/comment.css"><div class="comment-container">
    <div class="comment">
            <a class="comment-user-container" href="<?php echo "/profile.php?userID=".$commentAuthorID?>">
                <img src="<?php echo "../user/".$commentAuthorID."/profileImage.png?a=".date("H:i:s") ?>" alt="Profile Image">
                <div><?php echo $commentAuthorUsername ?></div>
            </a>

            <form style="display: none;" id="deleteCommentForm<?php echo $commentID ?>" method="post">
                <input type="number" name="commentID" value=<?php echo $commentID ?>>
                <input type="number" name="postID" value=<?php echo $postID ?>>
                <input type="submit" name="deleteComment" id="deleteComment<?php echo $commentID ?>">
            </form>
        
            <script>
                $("#deleteCommentForm<?php echo $commentID ?>").submit(function(event){
                    event.preventDefault();

                    $.post("/action/deleteCommentAction.php",{
                        postID: <?php echo $postID ?>,
                        commentID: <?php echo $commentID ?>,
                    },function(){
                        $.post("/action/getCommentCountAction.php",{
                            postID: <?php echo $postID ?>,
                        },function(data){
                            $("#commentCountContainer<?php echo $postID ?>").html(data)
                        });

                        $("#deleteCommentForm<?php echo $commentID ?>").parents(".comment-container").remove();
                    });
                });
            </script>

            <?php
            if($commentAuthorID == $_SESSION["user_id"]){
            ?>

            <label id="deleteComment" for="deleteComment<?php echo $commentID ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path></svg>
            </label>

            <?php
            }
            ?>

        <div class="comment-text-container">
            <pre><?php echo $commentText ?></pre>
        </div>
    </div>
</div>