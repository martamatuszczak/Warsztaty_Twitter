<!DOCTYPE html>
<?php
    session_start();   
    require_once './src/User.php';
    require_once './src/Tweet.php';
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
                  <li class="active"><a href='all_users.php'>All users</a></li>
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
                <h1>Choose user</h1>
            </div>
           
        <?php
        $sql = "SELECT * FROM User WHERE active=1";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            echo(
                '<div class="row">
                  <div class="col-md-12">
                        <div class="list-group">');
            while($row = $result->fetch_assoc()) {
                echo("<a class='tweet_link list-group-item' href='user_page.php?id={$row['id']}'>Użytkownik: {$row['fullName']} E-mail: {$row['email']}</a>");
            }
            echo(
                        '</div>
                  </div>
                </div>');
        }
        ?>
        </div> 
    </body>
</html>
