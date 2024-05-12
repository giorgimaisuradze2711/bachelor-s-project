<?php 

    class LikeControl extends LikeModel{
        
        private $userID;
        private $postID;

        public function __construct($userID, $postID){

            $this->userID = $userID;
            $this->postID = $postID;

        }

        public function setInsertLike(){

            $this->insertLike($this -> userID, $this -> postID);

        }

        public function setDeleteLike(){

            $this -> deleteLike($this -> userID, $this -> postID);

        }

    }