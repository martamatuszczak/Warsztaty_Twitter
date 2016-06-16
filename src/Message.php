<?php

class Message {
    
    public static function getMessageById(mysqli $conn, $id) {
        $sql="SELECT * FROM Message WHERE id = '$id'";
        
        $result = $conn->query($sql);
        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        }
        else {
            return false;
        }
    }
    
    public static function loadAllMessagesSent(mysqli $conn, $userId) {
        $sql = "SELECT * FROM Message WHERE author_id = $userId";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            $sentMessagesArray = [];
            while($row = $result->fetch_assoc()) {
                $messageSent = new Message();
                $messageSent->id = $row['id'];
                $messageSent->receiverId = $row['receiver_id'];
                $messageSent->authorId = $userId;
                $messageSent->text = $row['text'];
                $messageSent->title = $row['title'];
                $sentMessagesArray[] = $messageSent;            
            }
            
            return $sentMessagesArray;
        }
        
    }
    
    public static function loadAllMessagesReceived(mysqli $conn, $userId) {
        $sql = "SELECT * FROM Message WHERE receiver_id = $userId";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            $receivedMessagesArray = [];
            while($row = $result->fetch_assoc()) {
                $messageReceived = new Message();
                $messageReceived->id = $row['id'];
                $messageReceived->receiverId = $userId;
                $messageReceived->authorId = $row['author_id'];
                $messageReceived->text = $row['text'];
                $messageReceived->title = $row['title'];
                $messageReceived->status = $row['status'];
                $receivedMessagesArray[] = $messageReceived;                   
            }
            
            return $receivedMessagesArray;
        }
        
    }
    
    private $id;
    private $authorId;
    private $receiverId;
    private $title;
    private $text;
    private $status;
    

    function __construct() {
        $this->id = -1;
        $this->authorId = 0;
        $this->receiverId = 0;
        $this->title = "";
        $this->text = "";
        $this->status = 0;
    }
        
    public function getId() {
        return $this->id;
    }
    
    public function setAuthorId($authorId) {
        $this->authorId = $authorId;
    }
    
    public function getAuthorId() {
        return $this->authorId;
    }
    
    public function setReceiverId($receiverId) {
        $this->receiverId = $receiverId;
    }
    
    public function getReceiverId() {
        return $this->receiverId;
    }
    
    function getTitle() {
        return $this->title;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    
    function setText($text) {
        $this->text = $text;
    }
    
    function getText() {
        return $this->text;
    }
   
    function statusRead () {
        $this->status = 1;
    }
    
    function getStatus() {
        return $this->status;
    }
    
    function saveMessageToDB(mysqli $conn) {
        $sql = "INSERT INTO Message (author_id, receiver_id, title, text, status) VALUES ('{$this->authorId}', '{$this->receiverId}', '{$this->title}', '{$this->text}', '{$this->status}')";

        if($conn->query($sql)) {
            $this->id = $conn->insert_id;
            return TRUE;
        }
        else {
            return false;
        }
    }
    
    function loadFromDB(mysqli $conn, $id) {
        
        $sql = "SELECT * FROM Message WHERE id=$id";
        $result = $conn->query($sql);
        if($result->num_rows == 1) {
            $rowMessage = $result->fetch_assoc();
            $this->id = $rowMessage['id'];
            $this->authorId = $rowMessage['author_id'];
            $this->receiverId = $rowMessage['receiver_id'];
            $this->title = $rowMessage['title'];
            $this->text = $rowMessage['text'];
            $this->status = $rowMessage['status'];
            
        }
        else {
            return null;
        }
    }
    
}