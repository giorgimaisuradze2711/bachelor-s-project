<link rel="stylesheet" href="/css/commentForm.css">

<form class="comment-form" id="commentForm<?php echo $postID ?>">
    <div class="textbox-container">
        <img src=<?php echo "../user/".$_SESSION["user_id"]."/profileImage.png"?> alt="Profile Image">
        <textarea name="commentText" id="commentText<?php echo $postID ?>" rows="1" placeholder="Write Your Comment Here"></textarea>
    </div>

    <input type="submit" id="addComment<?php echo $postID ?>" value="Add Comment">
</form>

<script>
    $(document).ready(function(){
        $("#commentForm<?php echo $postID ?>").submit(function(event){
            event.preventDefault();
            $.post("/jQuery/addComment.php",
            {
                postID: <?php echo $postID ?>,
                commentText: $("#commentText<?php echo $postID ?>").val(),
            },
            function(data){
                $.post("/jQuery/getCommentCount.php",
                {
                    postID: <?php echo $postID ?>,
                }, 
                function(data){
                    $("#commentCountContainer<?php echo $postID ?>").html(data)
                });

                $("#commentForm<?php echo $postID ?>")[0].reset();
                $("#commentList<?php echo $postID ?>").prepend(data);
                $("#noComment<?php echo $postID ?>").remove();
            });
        });
    });
</script>