<?php
class CommentModel extends Database{
    protected function insertComment($userID, $postID, $commentText){
        $stmt = $this->connect()->prepare("INSERT INTO comments (user_id, post_id, comment_text) VALUE (?, ?, ?);");
        if(!$stmt->execute(array($userID, $postID, $commentText))){
            $stmt = null;
            header("location: ../index.php?error=unexpectedError");
            exit();
        }
    }

        protected function deleteComment($commentID){
            $stmt = $this->connect()->prepare("DELETE FROM comments where comment_id = ?;");

            if(!$stmt->execute(array($commentID))){

                $stmt = null;
                header("location: ../index.php?error=unexpectedError");
                exit();
            }
        }

        protected function selectCommentsByDateDesc($postID,$comentOffset, $commentCount){
            $stmt = $this->connect()->prepare("SELECT * FROM comments where post_id = ? ORDER BY comment_date DESC LIMIT ?,?;");
        
            if(!$stmt->execute(array($postID, $comentOffset, $commentCount))){
                $stmt = null;
                header("location: ../index.php?error=unexpectedError");
                exit();
            }

            $comment = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $comment;
        }
    }