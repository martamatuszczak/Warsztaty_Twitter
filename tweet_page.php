<!DOCTYPE html>
<?php
session_start();
require_once './src/User.php';
require_once './src/Tweet.php';
require_once './src/Comment.php';
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
                        <li><a href='messages_page.php'>Messages</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href='logout.php'>Logout</a> </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container text-center">
            <?php
            if (isset($_GET)) {
                $tweetId = $_GET['id'];
                
                
                $thisTweet = Tweet::show($conn, $tweetId);
                
                //Wyświetlanie imienia autora
                $userInfo = User::getUserById($conn, $thisTweet['user_id']);
                echo("<h3>Author: <a class='tweet_link' href='user_page.php?id={$thisTweet['user_id']}'>{$userInfo['fullName']}</a></h3>");
                //Wyświetlanie tweeta
                echo("<h3>Tweet:</h3>");
                echo("<div>{$thisTweet['text']}</div>");
                
                //Wyświetlanie komentarzy do tweeta
                $tweetComments = Tweet::loadAllComments($conn, $tweetId);
                echo("<h4>Comments:</h4>");
                echo("<dl>");
                for ($i = 0; $i < count($tweetComments); $i++) {
                    echo("<dt><a class='tweet_link' href='user_page.php?id={$thisTweet['user_id']}'> {$tweetComments[$i][0]}</a>    {$tweetComments[$i][2]}</dt>");
                    echo("<dd>{$tweetComments[$i][1]}</dd>");
                }
                echo("</dl>");
            }

            //Dodawanie komentarza
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!empty($_POST['comment'])) {
                    $newComment = new Comment();
                    $newComment->setTweetId($_GET['id']);
                    $newComment->setUserId($_SESSION['loggedUserId']);
                    $newComment->setCreationDate(date('Y-m-d G:i'));
                    $newComment->setText($_POST['comment']);
                    $newComment->saveCommentToDB($conn);
                    echo("Added comment");
                } else {
                    echo("Cannot add empty comment");
                }
            }
            $conn->close();
            $conn = null;
            ?>
            <form method="POST" role="form">
                <div class="form-group">
                    <textarea class="form-control" maxlength="100" name="comment"></textarea>
                </div>
                <input class="btn btn-info" type="submit" value="Add comment">
            </form>


        </div>    
    </body>
</html>

