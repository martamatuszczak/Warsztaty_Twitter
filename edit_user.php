<!DOCTYPE html>
<?php
session_start();   
require_once './src/User.php';
require_once './src/Tweet.php';
require_once './src/connection.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST">
            Nowy e-mail:
            <input type="email" name="new_email">
            Nowe imię:
            <input type="text" name="new_full_name">
            <button type="submit" name="submit" value="new_user_info">Edytuj</button>                
        </form>
        
        <form method="POST">
            Nowe hasło:
            <input type="password" name="new_password">
            Powtórz hasło:
            <input type="password" name="new_password_repeated">  
            <button type="submit" name="submit" value="new_password">Edytuj</button>
        </form>
        <?php
            $oldUser = new User();
            $oldUser->loadFromDB($conn, $_SESSION['loggedUserId']);
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                switch ($_POST['submit']) {
                    case 'new_user_info':
                        $oldUser->setEmail($_POST['new_email']);
                        $oldUser->setFullName($_POST['new_full_name']);
                        $oldUser->saveToDB($conn);
                        break;
                        
                    case 'new_password':
                        $oldUser->setPassword($_POST['new_password'], $_POST['new_password_repeated']);
                        echo("Nowe hasło" . $_POST['new_password']);
                        echo("Nowe hasło" . $_POST['new_password_repeated']);
                        $oldUser->saveToDB($conn);
                        break;      
                }
            }
        ?>
    </body>
</html>
