<?php
    class PostView extends PostModel{
        public function getPost( $postOffset, $postCount){
            $post = $this->selectPosts( $postOffset, $postCount);
            return $post;
        }
        
        public function getPostCount(){
            $postCount = $this->selectPostCount();
            return $postCount;
        } 

        public function getUserPost($userID, $postOffset, $postCount){
            $post = $this->selectUserPosts($userID, $postOffset, $postCount);
            return $post;
        } 

        public function getUserPostCount($userID){
            $userPostCount = $this->selectUserPostCount($userID);
            return $userPostCount;
        } 

        public function getPostByID($postID){
            $postsByID = $this->postByID($postID);
            return $postsByID;
        } 
    }