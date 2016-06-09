<!DOCTYPE html>
<?php
session_start();

if (isset($_SESSION['loggedUserId'])) {
    unset($_SESSION['loggedUserId']);
}

header("Location: login.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

    </body>
</html>
