<?php

class Tweet {
    
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
        $this->userId = is_int($userId) ?$userId :null;
    }
    
    function getUserID() {
        return $this->userId;
    }
    
    function setText($text) {
        $this->text = is_string($text) ?$text :null;
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
    
    function create(mysqli $conn) {
        
        $sql = "INSERT INTO Tweets (user_id, text) VALUES ('{$this->userId}', '{$this->text}'";

        if($conn->query($sql)) {
            $this->id = $conn->insert_id;
            return TRUE;
        }
        else {
            return false;
        }
    }
    
    function update(mysqli $conn) {
        
        $sql = "UPDATE Tweets SET user_id = '{$this->userId}' text = '{$this->text}'";
        
        if($conn->query($sql)) {
            return TRUE;
        }
        else {
            return false;
        }
    }
    
    function show() {
        
    }
    
    function getAllComments() {
        
    }
}