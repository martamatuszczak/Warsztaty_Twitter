<!DOCTYPE html>
<?php
session_start();
require_once './src/User.php';
require_once './src/connection.php';
require_once './src/Tweet.php';

if(!isset($_SESSION['loggedUserId'])) {
    header("Location: login.php");    
}

$userInfo = User::getUserById($conn, $_SESSION['loggedUserId']);
$userName = $userInfo['fullName'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/bootstrap.css">
        <title>Main paige</title>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
              <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Logo</a>
              </div>
              <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="index.php">Home</a></li>
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
              <div class="jumbotron">
                  <?php echo("<h1>Welcome $userName!</h1>")?>
              </div>
                <div class="row">  
                    <div class="col-md-12">
                    <div class="panel panel-default text-left">
                      <div class="panel-body">
                        <form method="post" role="form">
                            <div class="form-group">
                            <textarea class="form-control" name="tweet" maxlength="140"></textarea>
                            </div>
                            <input class="btn btn-info" type="submit" value="Tweet">
                        </form>   
                      </div>
                    </div>
                  </div>
                </div>
                <?php  
                if($_SERVER['REQUEST_METHOD'] === "POST") {
                    if(!empty($_POST['tweet'])) {
                        $text = $_POST['tweet'];
                        $userId = $_SESSION['loggedUserId'];
                        $newTweet = new Tweet();
                        $newTweet->setUserID($userId);
                        $newTweet->setText($text);
                        $newTweet->saveTweetToDB($conn);  
                    }
                    else {
                        echo("Cannot add empty tweet");
                    }
                }
                $allTweets = User::loadAllTweets($conn, $_SESSION['loggedUserId']);
                
                echo(
                '<div class="row">
                  <div class="col-md-12">
                    <div class="well">
                        <div class="list-group">');
                
                for($i = 0; $i < count($allTweets); $i++) {         
                    $tweetComments = Tweet::loadAllComments($conn, $allTweets[$i][0]);
                    $commentsCount = count($tweetComments);
                    echo("<a class='list-group-item' href='tweet_page.php?id={$allTweets[$i][0]}'>{$allTweets[$i][1]}<span class='badge'>$commentsCount</span></a>");
                }
                
                echo(
                        '</div>
                    </div>
                  </div>
                </div>');
                ?>
              </div>    
    </body>
</html>
