<?php

class CommentView extends CommentModel{
    public function getCommentsByDateDesc($postID, $commentOffset, $commentCount){
        $comment = $this->selectCommentsByDateDesc($postID,  $commentOffset, $commentCount);
        return $comment;
    }

    public function getCommentsCount(){
        $commentsCount = $this->selectCommentsCount();
        return $commentsCount;
    } 
}