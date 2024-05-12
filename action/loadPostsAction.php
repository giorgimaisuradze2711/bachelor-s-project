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

foreach ($posts as $post){

$postID = $post["PostID"];
$userID = $post["UserID"];
$postText = $post["PostText"];

$fecthPostAuthor = new UserView();
$postAuthor = $fecthPostAuthor -> fetchUser($userID);
$postAuthorUSername = $postAuthor[0]["Username"];

$postMediaPath = "../user/" . $userID . "/post/" . $postID . "/1*";
$postMedia = glob($postMediaPath);

if(isset($postMedia[0])){

    $postMediaFileType = strtolower(pathinfo($postMedia[0],PATHINFO_EXTENSION));

}

?>

<div class="post-container" id="postContainer<?php echo $postID ?>">

    <a class="post-user-container" href=<?php echo "/profile.php?userID=".$userID?>>
        <img src="<?php echo "/user/".$userID."/profileImage.jpg?a=".$time?>" alt="">
        <div><?php echo $postAuthorUSername ?></div>
    </a>

    <?php

    if(!empty($postText)){

    ?>

    <div class="post-text-container">
        <pre><?php echo $post["PostText"] ?></pre>
    </div>

    <?php

    } else {

        null;

    }

    if(isset($postMedia[0])){

        if($postMediaFileType == "mp4" || $postMediaFileType == "ogg"){

    ?>

    <div class="post-media-container">
        <video src="<?php echo $postMedia[0] ?>" controls></video>
    </div>

    <?php

    } else {

    ?>

    <div class="post-media-container">
        <a target="_blank" href="<?php echo $postMedia[0] ?>">
            <img src=<?php echo $postMedia[0] ?> alt="" >
        </a>
    </div>

    <?php

        }

    } else {

        null;

    }

    $selectLike = new LikeView();
    $like = $selectLike -> getCheckLike($_SESSION["UserID"], $postID);

    ?>

    <div class="post-interact">

        <div class="comment-interact-container">
        
            <button id="comment" class="interact-button">
                <svg onclick="showCommentSection<?php echo $postID ?>()"  width="24" height="24"><path d="M5 18v3.766l1.515-.909L11.277 18H16c1.103 0 2-.897 2-2V8c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h1zM4 8h12v8h-5.277L7 18.234V16H4V8z"></path><path d="M20 2H8c-1.103 0-2 .897-2 2h12c1.103 0 2 .897 2 2v8c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2z"></path></svg>
            </button>

            <div id="commentCountContainer<?php echo $postID ?>">
    
                <?php echo $post["Comments"] ?>

            </div>

        </div>

        <script>

            $(document).ready(function(){

                var like = <?php 

                    if($like){

                        echo "true";

                    } else {

                        echo "false";

                    }

                    ?>;
                
                var likeCount = <?php echo $post["Likes"]?>;

                $("#like<?php echo $postID ?>").click(function(){

                    if(like == false){

                        likeCount += 1;
                    
                        $.post("action/addLikeAction.php",
                        
                        {

                            postID: <?php echo $postID ?>,

                        },

                        function(data){

                            $("#likeCountContainer<?php echo $postID ?>").html(likeCount)
                            $("#like<?php echo $postID ?>").html('<svg  width="24" height="24"><path d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z"></path></svg>')
                            like = true;

                        });

                    } else {

                        likeCount -= 1;

                        $.post("action/deleteLikeAction.php",
                        
                        {

                            postID: <?php echo $postID ?>,

                        },

                        function(data){

                            $("#likeCountContainer<?php echo $postID ?>").html(likeCount)
                            $("#like<?php echo $postID ?>").html('<svg  width="24" height="24"><path d="M12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412l7.332 7.332c.17.299.498.492.875.492a.99.99 0 0 0 .792-.409l7.415-7.415c2.354-2.354 2.354-6.049-.002-8.416a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595zm6.791 1.61c1.563 1.571 1.564 4.025.002 5.588L12 18.586l-6.793-6.793c-1.562-1.563-1.561-4.017-.002-5.584.76-.756 1.754-1.172 2.799-1.172s2.035.416 2.789 1.17l.5.5a.999.999 0 0 0 1.414 0l.5-.5c1.512-1.509 4.074-1.505 5.584-.002z"></path></svg>')
                            like = false;

                        });     

                    };

                });

            });

        </script>

        <div class="like-interact-container">

            <button id="like<?php echo $postID ?>" class="interact-button like">

            <?php
            
            if($like){

            ?>

                <svg  width="24" height="24"><path d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z"></path></svg>

            <?php

            } else {

            ?>

                <svg  width="24" height="24"><path d="M12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412l7.332 7.332c.17.299.498.492.875.492a.99.99 0 0 0 .792-.409l7.415-7.415c2.354-2.354 2.354-6.049-.002-8.416a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595zm6.791 1.61c1.563 1.571 1.564 4.025.002 5.588L12 18.586l-6.793-6.793c-1.562-1.563-1.561-4.017-.002-5.584.76-.756 1.754-1.172 2.799-1.172s2.035.416 2.789 1.17l.5.5a.999.999 0 0 0 1.414 0l.5-.5c1.512-1.509 4.074-1.505 5.584-.002z"></path></svg>

            <?php

            }
            
            ?>

            </button>

            <div id="likeCountContainer<?php echo $postID ?>">
    
                <?php echo $post["Likes"] ?>

            </div>

        </div>

        <?php
    
        if($userID == $_SESSION["UserID"]){

        ?>

        <div class="interact-button">
            <svg id="postMenu" width="24" height="24"><path d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 12c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path></svg>
        </div>
        
        <?php

        } else {

            null;

        }

        ?>

    </div>

    <script>

        $(document).ready(function(){

            var commentLimit = 2;
            var commentOffset = 0;

            $("#showMoreComments<?php echo $postID ?>").click(function(){

                commentOffset = commentOffset + 2;
                
                $.post("action/loadCommentsAction.php",
                
                {

                    commentLimit: commentLimit,
                    commentOffset: commentOffset,
                    postID: <?php echo $postID ?>,

                },

                function(data){

                    $.post("/action/getCommentCountAction.php",
            
                    {

                        postID: <?php echo $postID ?>,

                    }, 

                    function(data){

                        $("#commentCountContainer<?php echo $postID ?>").html(data)
                        
                        if(commentOffset + 2 >= data){

                            $("#commentsList<?php echo $postID ?>").append($("<button class='no-comments'>That's all The Comments For Now,<a href='#postContainer<?php echo $postID ?>'>Go Back To The Post</a>.</button>"));
                            $("#showMoreComments<?php echo $postID ?>").remove();

                        };

                    });

                    $("#commentsList<?php echo $postID ?>").append(data);

                });
                
            });

            $("#commentForm<?php echo $postID ?>").submit(function(event){

                event.preventDefault();

                $.post("/action/addCommentAction.php",
                
                {

                    postID: <?php echo $postID ?>,
                    userID: <?php echo $userID ?>,
                    commentText: $("#commentText<?php echo $postID ?>").val(),

                },

                function(data){

                    $.post("/action/getCommentCountAction.php",
            
                    {

                        postID: <?php echo $postID ?>,

                    }, 

                    function(data){

                        $("#commentCountContainer<?php echo $postID ?>").html(data)

                    });

                    $("#commentForm<?php echo $postID ?>")[0].reset();
                    $("#commentsList<?php echo $postID ?>").prepend(data);
                    $("#noComment").remove();

                });
                
            });

        });

    </script>

    <div id="commentSection<?php echo $postID ?>" class="comment-section">
    
     <form class="comment-form" id="commentForm<?php echo $postID ?>" action="action/commentAction.php" method="post">

                <div class="comment-text-input">
                    <img src=<?php echo "/user/".$_SESSION["UserID"]."/profileImage.jpg?"?> alt="">
                    <textarea name="commentText" id="commentText<?php echo $postID ?>" rows="1" placeholder="Write Your Comment Here"></textarea>
                </div>

                <input style="display: none;" type="number" name="postID" value=<?php echo $postID ?>>
                <input type="submit" name="addComment<?php echo $postID ?>" id="addCommnet" value="Add Comment">

            </form>

        <div id="commentsList<?php echo $postID ?>">

            <?php

            $commentOffset = 0;
            $commentLimit = 2;
            $selectComments = new CommentView();
            $comment = $selectComments -> getCommentsByDateDesc($postID, $commentOffset, $commentLimit);

            foreach ($comment as $comment){

                $commentID = $comment["CommentID"];
                $commentAuthorID = $comment["UserID"];
                $commentText = $comment["CommentText"];
                $commentDate = $comment["CommentDate"];

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

            <?php

            }

            ?>

        </div>

        <?php

        if($post["Comments"] > $commentLimit ){

        ?>

        <button class="show-more-comments" id="showMoreComments<?php echo $postID ?>">Show More Comments</button>

        <?php

        } elseif($post["Comments"] == 0) {

        ?>

            <button id="noComment" class="no-comments">There Are No Comments, Be The First To Add One.</button>
        
        <?php

        }

        ?>

    </div>

    <script>

        function showCommentSection<?php echo $postID ?>(){

            var commentSection = document.getElementById("commentSection<?php echo $postID ?>")

            if(commentSection.style.display !== "block"){

                commentSection.style.display = "block"

            } else {

                commentSection.style.display = "none"

            }

        }

    </script>

</div>

<?php

}

?>