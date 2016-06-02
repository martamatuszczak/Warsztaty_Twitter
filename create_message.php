<!DOCTYPE html>
<?php
session_start();   
require_once './src/User.php';
require_once './src/Tweet.php';
require_once './src/Message.php';
require_once './src/connection.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST">
            Tytuł:
            <br>
            <input type="text" name="title"><br>
            Wiadomość:
            <br>
            <textarea name="message"></textarea><br>
            <input type="submit" value="Wyślij">
        </form>
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
                    echo("Wiadomość wysłana");
                }
                else {
                    echo("Nie możesz wysłać pustej wiadomości");
                }
            }
            
        ?>
    </body>
</html>
