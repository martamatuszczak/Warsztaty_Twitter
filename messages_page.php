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
                    $userMessagesSent = User::loadAllMessagesSent($conn, $userId); 
                        echo("<ul class='list-group'>");
                        for($i = 0; $i < count($userMessagesSent); $i++) {         
                                echo("<li class='list-group-item'>Message to:
                                <a class='tweet_link' href='user_page.php?id={$userMessagesSent[$i][1]}'>{$userMessagesSent[$i][2]}</a>
                                <br>Title: <a class='tweet_link' href='message_page.php?message_id={$userMessagesSent[$i][0]}&author_id=$userId&receiver_id={$userMessagesSent[$i][1]}'>{$userMessagesSent[$i][3]}</a></li>");  
                        }
                        echo("</ul></div></div>");

                    echo("<div class='row'>
                         <div class='col-md-12'>
                         <h2>Messages received</h2>");    
                    $userMessagesReceived = User::loadAllMessagesReceived($conn, $userId); 
                        echo("<ul class='list-group'>");
                        for($i = 0; $i < count($userMessagesReceived); $i++) {         
                                if($userMessagesReceived[$i][5] == 0) {
                                   echo("<li class='list-group-item'>Message from:
                                    <a class = 'tweet_link' href='user_page.php?id={$userMessagesReceived[$i][1]}'>{$userMessagesReceived[$i][2]}</a>
                                    <br>Title: <a class = 'tweet_link unread' href='message_page.php?message_id={$userMessagesReceived[$i][0]}&receiver_id=$userId&author_id={$userMessagesReceived[$i][1]}'>{$userMessagesReceived[$i][3]}</a></li>"); 
                                }
                                else {
                                    echo("<li class='list-group-item'>Message from:
                                    <a class = 'tweet_link' href='user_page.php?id={$userMessagesReceived[$i][1]}'>{$userMessagesReceived[$i][2]}</a>
                                    <br>Title: <a class = 'read' href='message_page.php?message_id={$userMessagesReceived[$i][0]}&receiver_id=$userId&author_id={$userMessagesReceived[$i][1]}'>{$userMessagesReceived[$i][3]}</a></li>");
                                }         
                        }
                        echo("</ul></div></div>"); 
                    ?>   
        </div>    
    </body>
</html>
