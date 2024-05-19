<?php

use LDAP\Result;

    class PostControl extends PostModel{

        private $postID;
        private $userID;
        private $postText;
        private $postMedia;
        private $postMediaURL;

        public function __construct($postID, $userID, $postText, $postMedia, $postMediaURL){

            $this->postID = $postID; 
            $this->userID = $userID;
            $this->postText = $postText;
            $this->postMedia = $postMedia;
            $this->postMediaURL = $postMediaURL;
        }

        public function setPost(){
            if($this -> emptyPost() == true){
                header("location: ../index.php?error=emptyPost");
                exit();
            }
            if($this -> invalidFileSize() == true){
                header("location: ../index.php?error=invalidFileSize");
                exit();
            }
            if($this -> invalidFileType() == true){
                header("location: ../index.php?error=invalidFileType");
                exit();
            }

            $this -> checkLink();
            $this -> insertPost($this -> userID, $this -> postText, $this -> postMedia);
        }

        public function setPostMedia(){
            $this -> insertPostMedia($this -> postMediaURL, $this -> postID);
        }

        public function increaseCommentCount(){

            $this -> updateCommentCountAdd($this -> postID);

        }

        public function decreaseCommentCount(){

            $this -> updateCommentCountSubtract($this -> postID);

        }

        public function increaseLikeCount(){

            $this -> updateLikeCountAdd($this -> postID);

        }

        public function decreaseLikeCount(){

            $this -> updateLikeCountSubtract($this -> postID);

        }

        private function checkLink(){

            $linkPattern = "/(((http|https|ftp|ftps)\:\/\/)|(www\.))[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/";

            $this -> postText =  preg_replace($linkPattern, '<a href="$0" target="_blank" >$0</a>', $this -> postText);

        }

        private function emptyPost(){

            $result = null;

            if(empty($this -> postText) and empty($this -> postMedia["name"])){

                $result = true;

            } else {

                $result = false;

            }

            return $result;

        }

        private function invalidFileSize(){

            $result = null;

            if($this -> postMedia["size"] > 60000000){

                $result = true;

            } else {

                $result = false;

            }

            return $result;
 
        }

        private function invalidFileType(){

            $result = null;

            if($this -> postMedia["type"] == "image/svg+xml"){

                $result = true;
    
            } else {

                $result = false;

            }

            return $result;
 
        }

    }