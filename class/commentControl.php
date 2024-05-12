<?php

    class CommentControl extends CommentModel{

        private $commentID;
        private $postID;
        private $userID;
        private $commentText;

        public function __construct($commentID, $postID, $userID, $commentText){

            $this->commentID = $commentID;
            $this->postID = $postID;
            $this->userID = $userID;
            $this->commentText = $commentText;
            
        }

        public function setInsertComment(){

            if($this -> emptyComment() == true){

                die("Empty Comment");

            }

            $this -> checkLink();

            $this->insertComment($this -> postID, $this -> userID, $this -> commentText);

        }

        public function setDeleteComment(){

            $this -> deleteComment($this -> commentID);

        }

        private function checkLink(){

            $linkPattern = "/(((http|https|ftp|ftps)\:\/\/)|(www\.))[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/";

            $this -> commentText =  preg_replace($linkPattern, '<a href="$0" target="_blank" >$0</a>', $this -> commentText);

        }

        private function emptyComment(){

            $result = null;

            if(empty($this -> commentText)){

                $result = true;

            } else {

                $result = false;

            }

            return $result;

        }

    }