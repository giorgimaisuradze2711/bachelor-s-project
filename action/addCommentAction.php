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
    $userID = $_SESSION["UserID"];
    $commenText = $_POST["commentText"];

    $insertComment = new CommentControl(null, $postID, $userID, $commenText);
    $insertComment -> setInsertComment();

    $updateCommentCount = new PostControl($postID, null, null, null);
    $updateCommentCount -> increaseCommentCount();

    $selectComments = new CommentView();
    $comment = $selectComments -> getCommentsByDateDesc($postID, 0, 1);

    $commentID = $comment[0]["CommentID"];
    $commentAuthorID = $comment[0]["UserID"];
    $commentText = $comment[0]["CommentText"];
    $commentDate = $comment[0]["CommentDate"];

    $fetchCommentAuthor = new UserView();
    $commentAuthor = $fetchCommentAuthor -> fetchUser($commentAuthorID);
    $commentAuthorUsername = $commentAuthor[0]["Username"];

?>

    <div class="comment-container">

    <div class="comment">

        <div class="comment-user-control">

            <a class="comment-user-container" href="<?php echo "/profile.php?userID=".$commentAuthorID?>">

                <img src="<?php echo "/user/".$commentAuthorID."/profileImage.jpg?a=".date("H:i:s") ?>" alt="">
                <div><?php echo $commentAuthorUsername ?></div>

            </a>

            <form style="display: none;" id="deleteCommentForm<?php echo $commentID ?>" action="action/commentAction.php" method="post">

                <input type="number" name="commentID" value=<?php echo $commentID ?>>
                <input type="number" name="postID" value=<?php echo $postID ?>>
                <input type="submit" name="deleteComment" id="deleteComment<?php echo $commentID ?>">

            </form>

                        
            <script>

                $("#deleteCommentForm<?php echo $commentID ?>").submit(function(event){

                    event.preventDefault();

                    $.post("/action/deleteCommentAction.php",
                    
                    {

                        postID: <?php echo $postID ?>,
                        commentID: <?php echo $commentID ?>,

                    },

                    function(){

                        $.post("/action/getCommentCountAction.php",
                        
                        {

                            postID: <?php echo $postID ?>,

                        }, 

                        function(data){

                            $("#commentCountContainer<?php echo $postID ?>").html(data)

                        });

                        $("#deleteCommentForm<?php echo $commentID ?>").parents(".comment-container").remove();

                    });

                });

            </script>

            <?php
            
            if($commentAuthorID == $_SESSION["UserID"]){

            ?>

            <label id="deleteComment" for="deleteComment<?php echo $commentID ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path></svg>
            </label>

            <?php

            } else {

                null;

            }
            
            ?>

        </div>

        <div class="comment-text-container">
            <pre><?php echo $commentText ?></pre>
        </div>

    </div>

</div>