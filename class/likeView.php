<?php

    class LikeView extends LikeModel{

        public function getCheckLike($userID, $postID){

            $result = null;

            if($this-> checkLike($userID, $postID)){

                $result = true;

            } else {

                $result = false;

            }

            return $result;

        }

    }