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
        <h2>Wiadomości wysłane</h2>
        <?php
        $userId = $_SESSION['loggedUserId'];
        $userMessagesSent = User::loadAllMessagesSent($conn, $userId); 
            echo("<ul>");
            for($i = 0; $i < count($userMessagesSent); $i++) {         
                    echo("<li>Wiadomość do:
                    <a href='user_page.php?id={$userMessagesSent[$i][1]}'>{$userMessagesSent[$i][2]}</a>
                    <br> Tytuł: <a href='message_page.php?message_id={$userMessagesSent[$i][0]}&author_id=$userId&receiver_id={$userMessagesSent[$i][1]}'>{$userMessagesSent[$i][3]}</a></li>");  
            }
            echo("</ul>");
            
        echo("<h2>Wiadomości odebrane</h2>");    
        $userMessagesReceived = User::loadAllMessagesReceived($conn, $userId); 
            echo("<ul>");
            for($i = 0; $i < count($userMessagesReceived); $i++) {         
                    if($userMessagesReceived[$i][5] == 0) {
                       echo("<li>Wiadomość od:
                        <a class = 'unread' href='user_page.php?id={$userMessagesReceived[$i][1]}'>{$userMessagesReceived[$i][2]}</a>
                        <br> Tytuł: <a class = 'unread' href='message_page.php?message_id={$userMessagesReceived[$i][0]}&receiver_id=$userId&author_id={$userMessagesReceived[$i][1]}'>{$userMessagesReceived[$i][3]}</a></li>"); 
                    }
                    else {
                        echo("<li>Wiadomość od:
                        <a class = 'read' href='user_page.php?id={$userMessagesReceived[$i][1]}'>{$userMessagesReceived[$i][2]}</a>
                        <br> Tytuł: <a class = 'read' href='message_page.php?message_id={$userMessagesReceived[$i][0]}&receiver_id=$userId&author_id={$userMessagesReceived[$i][1]}'>{$userMessagesReceived[$i][3]}</a></li>");
                    }         
            }
            echo("</ul>");
            
        echo("<a href='index.php'>Strona główna </a>");    
        ?>
    </body>
</html>
