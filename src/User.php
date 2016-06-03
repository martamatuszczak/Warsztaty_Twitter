<?php

class User {
    
    public static function getUserByEmail(mysqli $conn, $email) {
        $sql="SELECT * FROM User WHERE email = '$email'";
        
        $result = $conn->query($sql);
        if($result->num_rows == 1) {
            return $result->fetch_assoc();
        }
        else {
            return false;
        }
    }
    
    public static function getUserById(mysqli $conn, $id) {
        $sql="SELECT * FROM User WHERE id = '$id'";
        
        $result = $conn->query($sql);
        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if($row['active'] == 1) {
                return $row;
            }
            return false;
        }
        else {
            return false;
        }
    }
    
    public static function login(mysqli $conn, $email, $password) {
        $sql = "SELECT * FROM User WHERE email = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows == 1) {
            $rowUser = $result->fetch_assoc();
           if(password_verify($password, $rowUser['password']) && $rowUser['active'] == 1) {
               return $rowUser['id'];
           }
           else {
               return false;
           }
        }
        else {
            return false;
        }
    }
    
    public static function loadAllTweets(mysqli $conn, $userId) {
        $sql = "SELECT * FROM Tweet WHERE user_id = $userId";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            $tweetsArray = [];
            while($row = $result->fetch_assoc()) {
                $tweetsArray[]= [$row['id'], $row['text']];             
            }
            
            return $tweetsArray;
        }
        
    }
    
    public static function loadAllMessagesSent(mysqli $conn, $userId) {
        $sql = "SELECT Message.id, Message.receiver_id, User.fullName, Message.title, Message.text 
                FROM Message JOIN User ON Message.receiver_id = User.id
                WHERE author_id = $userId";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            $sentMessagesArray = [];
            while($row = $result->fetch_assoc()) {
                $sentMessagesArray[]= [$row['id'], $row['receiver_id'], $row['fullName'], $row['title'], $row['text']];             
            }
            
            return $sentMessagesArray;
        }
        
    }
    
    public static function loadAllMessagesReceived(mysqli $conn, $userId) {
        $sql = "SELECT Message.id, Message.author_id, User.fullName, Message.title, Message.text, Message.status 
                FROM Message JOIN User ON Message.author_id = User.id
                WHERE receiver_id = $userId";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            $receivedMessagesArray = [];
            while($row = $result->fetch_assoc()) {
                $receivedMessagesArray[]= [$row['id'], $row['author_id'], $row['fullName'], $row['title'], $row['text'], $row['status']];             
            }
            
            return $receivedMessagesArray;
        }
        
    }

    private $id;
    private $email;
    private $password;
    private $fullName;
    private $active;
    
    public function __construct() {
        $this->id = -1;
        $this->email = "";
        $this->password = "";
        $this->fullName = "";
        $this->active = 0;
    }
    
    public function setEmail($email) {
        $this->email = is_string($email) ?trim($email) :$this->email; 
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setPassword($password, $retypedPassword) {
        if($password != $retypedPassword) {
            return false;
        }
        
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        return true;
        
    }
    
    public function setFullName($fullName) {
        $this->fullName = is_string($fullName) ?trim($fullName) :$this->fullName;
    }
    
    public function getFullName() {
        return $this->fullName;
    }
    
    public function activate() {
        $this->active = 1;
    }
    
    public function deactivate() {
        $this->active = 0;
    }
    
    public function getActive() {
        return $this->active;
    }
    
    public function saveToDB(mysqli $conn) {
        if($this->id == -1) {
            $sql = "INSERT INTO User (email, password, fullName, active)
                    VALUES ('{$this->email}', '{$this->password}', '{$this->fullName}', {$this->active})";
                    
            if($conn->query($sql)) {
                $this->id = $conn->insert_id;
                return TRUE;
            }        
            else {
                return false;
            }
        }
        else {
            $sql = "UPDATE User SET 
                    email = '{$this->email}', 
                    password = '{$this->password}',
                    fullName = '{$this->fullName}', 
                    active = '{$this->active}'
                    WHERE id = {$this->id}";
                    
            if($conn->query($sql)) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
    }
    
    
    public function loadFromDB(mysqli $conn, $id) {
        $sql = "SELECT * FROM User WHERE id=$id";
        $result = $conn->query($sql);
        if($result->num_rows == 1) {
            $rowUser = $result->fetch_assoc();
            $this->id = $rowUser['id'];
            $this->email = $rowUser['email'];
            $this->password = $rowUser['password'];
            $this->fullName = $rowUser['fullName'];
            $this->active = $rowUser['active'];
            return $this;
        }
        else {
            return null;
        }
    }
    
    
    
}
