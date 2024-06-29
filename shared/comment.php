<link rel="stylesheet" href="/css/comment.css"><div class="comment-container">
    <div class="comment" id="comment<?php echo $commentID ?>">
            <div class="user-container">
                <img src=<?php echo "../user/".$commentAuthorID."/profileImage.png" ?> alt="Profile Image">   
                <a href="/page/profile.php?user_id=<?php echo $commentAuthorID?>"><?php echo $commentAuthorUsername ?></a>

                <?php
                if($commentAuthorID == $_SESSION["user_id"]){
                ?>

                <button class="delete-comment-button" id="deleteCommentButton<?php echo $commentID ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z"></path></svg>
                </button>

                <?php
                }
                ?>
            </div>
        
            <script>
                $("#deleteCommentButton<?php echo $commentID ?>").click(function(event){
                    $.post("/jQuery/deleteComment.php",{
                        postID: <?php echo $postID ?>,
                        commentID: <?php echo $commentID ?>,
                    },
                    function(){
                        $.post("/jQuery/getCommentCount.php",{
                            postID: <?php echo $postID ?>,
                        },function(data){
                            $("#commentCountContainer<?php echo $postID ?>").html(data)
                            $("#comment<?php echo $commentID ?>").remove();
                            
                            if(data == 0){
                                $("#commentList<?php echo $postID ?>").append('<div id="noComment<?php echo $postID ?>" class="no-comments">There Are No Comments, Be The First To Add One.</div>');
                            }
                        }); 
                    });
                });
            </script>

        <div class="comment-text">
            <pre><?php echo $commentText ?></pre>
        </div>
    </div>
</div>