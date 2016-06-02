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
        <h2>Wiadomości wysłane</h2>
        <?php
        $userId = $_SESSION['loggedUserId'];
        $userMessagesSent = User::loadAllMessagesSent($conn, $userId); 
            echo("<ul>");
            for($i = 0; $i < count($userMessagesSent); $i++) {         
                    echo("<li>Wiadomość do:
                    <a href='user_page.php?id={$userMessagesSent[$i][1]}'>{$userMessagesSent[$i][2]}</a>
                    <br> Tytuł: <a href='message_page.php?id={$userMessagesSent[$i][0]}&receiver_id={$userMessagesSent[$i][1]}'>{$userMessagesSent[$i][3]}</a></li>");  
            }
            echo("</ul>");
            
        echo("<h2>Wiadomości odebrane</h2>");    
        $userMessagesReceived = User::loadAllMessagesReceived($conn, $userId); 
            echo("<ul>");
            for($i = 0; $i < count($userMessagesReceived); $i++) {         
                    echo("<li>Wiadomość od:
                    <a href='user_page.php?id={$userMessagesReceived[$i][1]}'>{$userMessagesReceived[$i][2]}</a>
                    <br> Tytuł: <a href='message_page.php?id={$userMessagesReceived[$i][0]}&author_id={$userMessagesReceived[$i][1]}'>{$userMessagesReceived[$i][3]}</a></li>");  
            }
            echo("</ul>");
            
        echo("<a href='index.php'>Strona główna </a>");    
        ?>
    </body>
</html>
