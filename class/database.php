<?php
class Database{
    protected function connect(){
        try{
            $dns = "mysql:dbname=bachelorsproject;host=localhost";
            $username = "root";
            $password = "";
            $dbh = new PDO($dns, $username, $password);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
            return $dbh;
        } catch(PDOException $exception){
            print "Error: " . $exception->getMessage() . "<br>";
            die();
        }
    }
}
