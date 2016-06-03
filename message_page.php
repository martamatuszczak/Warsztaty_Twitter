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
        <title></title>
    </head>
    <body>
        <?php
        $loggedUserId = $_SESSION['loggedUserId'];
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            //Nadawca
            if(isset($_GET['author_id'])) {
                $authorInfo = User::getUserById($conn, $_GET['author_id']);
                echo("<h2>Author: {$authorInfo['fullName']}</h2>");
            }
            //Odbiorca
            if(isset($_GET['receiver_id'])) {
                $receiverInfo = User::getUserById($conn, $_GET['receiver_id']);
                echo("<h2>Receiver: {$receiverInfo['fullName']}</h2>");
            }
            //Treść
            if(isset($_GET['message_id'])) {
                $messageInfo = Message::getMessageById($conn, $_GET['message_id']);
                echo("<h2>Title: {$messageInfo['title']}</h2><p>{$messageInfo['text']}</p>");
            }
            //Zmiana statusu na przeczytany
            if($_GET['author_id'] !== $loggedUserId) {
                $sql = "UPDATE Message SET status=1 WHERE id={$_GET['message_id']} ";
                if($conn->query($sql) === TRUE) {
                    echo("Message read");
                }
                else {
                    echo("Connection error");
                }
            }
        }
        
        echo("<a href='messages_page.php'>All messages  </a>");
        echo("<a href='index.php'>Home</a>");
        
        ?>
    </body>
</html>
