<?php 

    class LikeModel extends Database{

        protected function insertLike($userID, $postID){

            $stmt = $this->connect()->prepare("INSERT INTO likes (UserID, PostID) VALUES (?, ?);");
            
            if(!$stmt->execute(array($userID, $postID))){

                $stmt = null;
    
                header("location: ../index.php?error=unexpectedError");
    
                exit();
    
            }

        }

        protected function deleteLike($userID, $postID){

            $stmt = $this->connect()->prepare("DELETE FROM likes where UserID = ? AND PostID = ?;");
            
            if(!$stmt->execute(array($userID, $postID))){

                $stmt = null;
    
                header("location: ../index.php?error=unexpectedError");
    
                exit();
    
            }

        }

        protected function checkLike($userID, $postID){

            $stmt = $this->connect()->prepare("SELECT * FROM likes WHERE UserID = ? AND PostID = ?");

            if(!$stmt->execute(array($userID, $postID))){

                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit();

            }

            $result = null;

            if($stmt->rowCount() > 0){

                $result = true;

            } else {

                $result = false;

            }

            return $result;

        }

    }