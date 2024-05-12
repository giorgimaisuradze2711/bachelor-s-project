<?php

    class PostModel extends Database{

        protected function insertPost($userID, $postText){

            $stmt = $this->connect()->prepare("INSERT INTO posts (user_id, post_text) VALUE (?, ?);");

            if(!$stmt->execute(array($userID, $postText))){

                $stmt = null;
    
                header("location: ../index.php?error=unexpectedError");
    
                exit();
    
            }

        }

        protected function updateCommentCountAdd($PostID){

            $stmt = $this -> connect() -> prepare("UPDATE posts set comments = comments + 1 WHERE post_id = ?");

            if(!$stmt->execute(array($PostID))){

                $stmt = null;
    
                header("location: ../index.php?error=unexpectedError");
    
                exit();
    
            }

        }

        protected function updateCommentCountSubtract($PostID){

            $stmt = $this -> connect() -> prepare("UPDATE posts set comments = comments - 1 WHERE post_id = ?");

            if(!$stmt->execute(array($PostID))){

                $stmt = null;
    
                header("location: ../index.php?error=unexpectedError");
    
                exit();
    
            }

        }

        protected function updateLikeCountAdd($PostID){

            $stmt = $this -> connect() -> prepare("UPDATE posts set likes = likes + 1 WHERE post_id = ?");

            if(!$stmt->execute(array($PostID))){

                $stmt = null;
    
                header("location: ../index.php?error=unexpectedError");
    
                exit();
    
            }

        }

        protected function updateLikeCountSubtract($PostID){

            $stmt = $this -> connect() -> prepare("UPDATE posts set likes = likes - 1 WHERE post_id = ?");

            if(!$stmt->execute(array($PostID))){

                $stmt = null;
    
                header("location: ../index.php?error=unexpectedError");
    
                exit();
    
            }

        }

        protected function selectPosts($postOffset, $postCount){

            $stmt = $this->connect()->prepare("SELECT * FROM posts ORDER BY post_date DESC LIMIT ?,?;");
            
            if(!$stmt->execute(array($postOffset, $postCount))){

                $stmt = null;
                header("location: ../index.php?error=unexpectedError");
                exit();
    
            }

            $post = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $post;

        }
        
        protected function selectPostCount(){

            $stmt = $this->connect()->prepare("SELECT * FROM posts;");
            
            if(!$stmt->execute()){

                $stmt = null;
    
                header("location: ../index.php?error=unexpectedError");
    
                exit();
    
            }

            $postCount = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $postCount;

        }

        protected function selectUserPosts($userID, $postOffset, $postCount){

            $stmt = $this->connect()->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY post_date DESC LIMIT ?,?;");
            
            if(!$stmt->execute(array($userID, $postOffset, $postCount))){

                $stmt = null;
    
                header("location: ../index.php?error=unexpectedError");
    
                exit();
    
            }

            $post = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $post;

        }

        protected function selectUserPostCount($userID){

            $stmt = $this->connect()->prepare("SELECT * FROM posts WHERE user_id = ?;");
            
            if(!$stmt->execute(array($userID))){

                $stmt = null;
    
                header("location: ../index.php?error=unexpectedError");
    
                exit();
    
            }

            $userPostCount = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $userPostCount;

        }

        protected function postByID($postID){

            $stmt = $this->connect()->prepare("SELECT * FROM posts WHERE post_id = ?;");
            
            if(!$stmt->execute(array($postID))){

                $stmt = null;
    
                header("location: ../index.php?error=unexpectedError");
    
                exit();
    
            }

            $postsByID = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $postsByID;
        }
    }