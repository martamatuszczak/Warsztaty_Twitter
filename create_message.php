<!DOCTYPE html>
<?php
session_start();   
require_once './src/User.php';
require_once './src/Tweet.php';
require_once './src/Message.php';
require_once './src/connection.php';

if(!isset($_SESSION['loggedUserId'])) {
    header("Location: login.php");    
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/bootstrap.css">
        <title></title>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
              <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Logo</a>
              </div>
              <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                  <li><a href="index.php">Home</a></li>
                  <li><a href='all_users.php'>All users</a></li>
                  <li><a href='messages_page.php'>Messages</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href='logout.php'>Logout</a> </li>
                </ul>
              </div>
            </div>
          </nav>
        <div class="container text-center">
            <h1>Create message</h1>
            <form method="POST" role="form">
                <div class="form-group">
                    <label>
                        Title:
                        <input class="form-control" type="text" name="title">
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        Message:
                        <textarea class="form-control" name="message"></textarea>
                    </label>
                </div>
                <input type="submit" class="btn btn-info" value="Send">
            </form>
            <br><br>
        <?php
            $authorId = $_SESSION['loggedUserId'];
            if(isset($_GET['id'])) {
                $receiverId = $_GET['id'];
            }
        
            if($_SERVER['REQUEST_METHOD'] === "POST") {
                if(!empty($_POST['message']) && !empty($_POST['title'])) {
                    $title = $_POST['title'];
                    $text = $_POST['message']; 
                    $newMessage = new Message();
                    $newMessage->setAuthorId($authorId);
                    $newMessage->setReceiverId($receiverId);
                    $newMessage->setTitle($title);
                    $newMessage->setText($text);
                    $newMessage->saveMessageToDB($conn);
                    echo("Message sent");
                }
                else {
                    echo("Cannot send empty message");
                }
            }
            echo("<a class='btn btn-info' href='user_page.php?id={$receiverId}'>Return to user page</a>"); 
        ?>
       </div>
    </body>
</html>
