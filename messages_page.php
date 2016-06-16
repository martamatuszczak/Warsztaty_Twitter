<!DOCTYPE html>
<?php
session_start();
require_once './src/User.php';
require_once './src/Tweet.php';
require_once './src/Message.php';
require_once './src/connection.php';

if (!isset($_SESSION['loggedUserId'])) {
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
                        <li class="active"><a href='messages_page.php'>Messages</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href='logout.php'>Logout</a> </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container text-center">   
            <div class="row">
                <div class="col-md-12">
                    <?php
                    echo("<h2>Messages sent</h2>");
                    $userId = $_SESSION['loggedUserId'];
                    $userMessagesSent = Message::loadAllMessagesSent($conn, $userId);                   
                    echo("<ul class='list-group'>");
                    for ($i = 0; $i < count($userMessagesSent); $i++) {
                        //Dane wiadomości
                        $messageId = $userMessagesSent[$i]->getId();
                        $messageTitle = $userMessagesSent[$i]->getTitle();
                        //Dane odbiorcy
                        $receiverId = $userMessagesSent[$i]->getReceiverId();
                        $receiver = new User();
                        $receiver->loadFromDB($conn, $receiverId);
                        $receiverName = $receiver->getFullName();
                        //Wyświetlanie listy wiadomości wysłanych
                        echo("<li class='list-group-item'>Message to:
                                <a class='tweet_link' href='user_page.php?id=$receiverId'>$receiverName</a>
                                <br>Title: <a class='tweet_link' href='message_page.php?message_id=$messageId&author_id=$userId&receiver_id=$receiverId'>$messageTitle</a></li>");
                    }
                    echo("</ul></div></div>");

                    echo("<div class='row'>
                         <div class='col-md-12'>
                         <h2>Messages received</h2>");
                    $userMessagesReceived = Message::loadAllMessagesReceived($conn, $userId);
                    echo("<ul class='list-group'>");
                    for ($i = 0; $i < count($userMessagesReceived); $i++) {
                        
                        //Dane wiadomości
                        $messageId = $userMessagesReceived[$i]->getId();
                        $messageTitle = $userMessagesReceived[$i]->getTitle();
                        //Dane odbiorcy
                        $authorId = $userMessagesReceived[$i]->getAuthorId();
                        $author = new User();
                        $author->loadFromDB($conn, $authorId);
                        $authorName = $author->getFullName();
                        
                        if ($userMessagesReceived[$i]->getStatus() == 0) {
                            echo("<li class='list-group-item'>Message from:
                                    <a class = 'tweet_link' href='user_page.php?id=$authorId'>$authorName</a>
                                    <br>Title: <a class = 'tweet_link unread' href='message_page.php?message_id=$messageId&receiver_id=$userId&author_id=$authorId'>$messageTitle</a></li>");
                        } else {
                            echo("<li class='list-group-item'>Message from:
                                    <a class = 'tweet_link' href='user_page.php?id=$authorId'>$authorName</a>
                                    <br>Title: <a class = 'read' href='message_page.php?message_id=$messageId&receiver_id=$userId&author_id=$authorId'>$messageTitle</a></li>");
                        }
                    }
                    echo("</ul></div></div>");
                    $conn->close();
                    $conn = null;
                    ?>   
                </div>    
    </body>
</html>
