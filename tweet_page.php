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
                
                
                $thisTweet = new Tweet();
                $thisTweet->loadFromDB($conn, $tweetId);
                
                //Showing tweet author name
                $user = new User();
                $userId = $thisTweet->getUserID();
                $user->loadFromDB($conn, $userId);
                $userName = $user->getFullName();
                echo("<h3>Author: <a class='tweet_link' href='user_page.php?id=$userId'>$userName</a></h3>");
                
                //Showing tweet
                echo("<h3>Tweet:</h3>");
                echo("<div>{$thisTweet->getText()}</div>");
                
                //Showing tweet comments
                $tweetComments = Comment::loadAllComments($conn, $tweetId);
                echo("<h4>Comments:</h4>");
                echo("<dl>");
                for ($i = 0; $i < count($tweetComments); $i++) {
                    
                    //Comment data
                    $commentText = $tweetComments[$i]->getText();
                    $commentDate = $tweetComments[$i]->getCreationDate();
                    
                    //Comment author data
                    $commentingUserId = $tweetComments[$i]->getUserId();
                    $commentingUser = new User();
                    $commentingUser->loadFromDB($conn, $commentingUserId);
                    $commentingUserName = $commentingUser->getFullName();
                    
                    //Generating comment list
                    echo("<dt><a class='tweet_link' href='user_page.php?id=$commentingUserId'>$commentingUserName </a>$commentDate</dt>");
                    echo("<dd>$commentText</dd>");
                }
                echo("</dl>");
            }

            //Adding comment
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

