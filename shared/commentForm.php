<form class="comment-form" id="commentForm<?php echo $postID ?>" action="action/commentAction.php" method="post">

<div class="comment-text-input">
    <img src=<?php echo "/user/".$_SESSION["user_id"]."/profileImage.jpg?"?> alt="">
    <textarea name="commentText" id="commentText<?php echo $postID ?>" rows="1" placeholder="Write Your Comment Here"></textarea>
</div>

<input style="display: none;" type="number" name="postID" value=<?php echo $postID ?>>
<input type="submit" name="addComment<?php echo $postID ?>" id="addCommnet" value="Add Comment">
</form>