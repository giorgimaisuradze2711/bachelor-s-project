<?php

    class CommentModel extends Database{

        protected function insertComment($PostID, $UserID, $CommentText){

            $stmt = $this->connect()->prepare("INSERT INTO comments (PostID, UserID, CommentText) VALUE (?, ?, ?);");

            if(!$stmt->execute(array($PostID, $UserID, $CommentText))){

                $stmt = null;
    
                header("location: ../index.php?error=unexpectedError");
    
                exit();
    
            }

        }

        protected function deleteComment($commentID){

            $stmt = $this->connect()->prepare("DELETE FROM comments where CommentID = ?;");
            
            if(!$stmt->execute(array($commentID))){

                $stmt = null;
    
                header("location: ../index.php?error=unexpectedError");
    
                exit();
    
            }

        }

        protected function selectCommentsByDateDesc($postID,$comentOffset, $commentCount){

            $stmt = $this->connect()->prepare("SELECT * FROM comments where PostID = ? ORDER BY CommentDate DESC LIMIT ?,?;");
            
            if(!$stmt->execute(array($postID, $comentOffset, $commentCount))){

                $stmt = null;
    
                header("location: ../index.php?error=unexpectedError");
    
                exit();
    
            }

            $comment = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $comment;

        }

    }