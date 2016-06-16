<?php
require_once 'User.php';

class Tweet {
       
    public static function loadAllTweets(mysqli $conn, $userId) {
        $sql = "SELECT * FROM Tweet WHERE user_id = $userId";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            $tweetsArray = [];
            while($row = $result->fetch_assoc()) {
                $tweet = new Tweet();
                $tweet->id = $row['id'];
                $tweet->text = $row['text'];
                $tweetsArray[]= $tweet;             
            }
            
            return $tweetsArray;
        }
        
    }
     
    private $id;
    private $userId;
    private $text;
    
    function __construct() {
        $this->id = -1;
        $this->userId = 0;
        $this->text = "";
    }
    
    
    function getID() {
        return $this->id;
    }
    
    function setUserID($userId) {
        $this->userId = is_numeric($userId) ?$userId :$this->userId;
    }
    
    function getUserID() {
        return $this->userId;
    }
    
    function setText($text) {
        $this->text = is_string($text) ?$text :$this->text;
    }
    
    function getText() {
        return $this->text;
    }
    
    function loadFromDB(mysqli $conn, $id) {
        
        $sql = "SELECT * FROM Tweet WHERE id=$id";
        $result = $conn->query($sql);
        if($result->num_rows == 1) {
            $rowTweet = $result->fetch_assoc();
            $this->id = $rowTweet['id'];
            $this->userId = $rowTweet['user_id'];
            $this->text = $rowTweet['text'];
            
        }
        else {
            return null;
        }
    }
    
    function saveTweetToDB(mysqli $conn) {

        $sql = "INSERT INTO Tweet (user_id, text) VALUES ('{$this->userId}', '{$this->text}')";

        if($conn->query($sql)) {
            $this->id = $conn->insert_id;
            return TRUE;
        }
        else {
            return false;
        }
    }
    
    function update(mysqli $conn) {
        
        $sql = "UPDATE Tweet SET user_id = '{$this->userId}' text = '{$this->text}')";
        
        if($conn->query($sql)) {
            return TRUE;
        }
        else {
            return false;
        }
    }
    
}