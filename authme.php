<?php
session_start();
if(isset($_SESSION['logged'])) {
    header('Location: index.php');
}
if(isset($_POST['name']) && isset($_POST['password'])) {
   $name = strtolower($_POST['name']);
   $name = htmlentities($name, ENT_QUOTES, "UTF-8");

   $mysql_connection = new mysqli('#', '#', '#', '#');
   if ($mysql_connection -> connect_errno) {
        exit();
   }
   $result = $mysql_connection->query('SELECT * FROM authme WHERE username="'.$name.'"');
   if($result->num_rows == 0)
    {
        $_SESSION['errorname'] = true;
        header('Location: authme.php');
        mysqli_close($mysql_connection);
        exit();
    }
    while($row = $result->fetch_assoc()) {
        $salt = substr($row['password'], 5, 16);
        $password = hash('sha256', hash('sha256', $_POST['password']).$salt);
        if($password == substr($row['password'], 22))
        {
            $result2 = $mysql_connection->query('SELECT * FROM luckperms_players WHERE username="'.$name.'" AND primary_group="admin"');
            if($result2->num_rows > 0)
            {
                $_SESSION['admin'] = true;
            }
            $_SESSION['logged'] = true;
            $_SESSION['name'] = $name;
            if(isset($row['email'])) {
                $_SESSION['email'] = $row['email'];
            }
            $_SESSION['id'] = $row['id'];
        } else
        {
            $_SESSION['errorpass'] = true;
            header('Location: authme.php');
            exit();
        }
    }
    mysqli_close($mysql_connection);
}
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="icon" href="img/favicon.ico">
        <title>BlackMC - Logowanie</title>
        <link rel="stylesheet" href="css/logowanie.min.css">
        <script src="js/showpass.js"></script>
    </head>
    <body>
        <form method="POST" action="authme.php" class="login-form">
            <p class="title">Logowanie</p>
            <input type="text" placeholder="Nick" name="name">
            <div id="passcontainer" style="position: relative; display: inline-block;">
                <input type="password" placeholder="Hasło" name="password" id="authpassword">
                <img src="img/eye.png" alt="Pokaż hasło" width="25px" height="25px" style="position: absolute; right:7px; top:8px;" id="eyeimg" onclick="showPass()">
            </div>
            <button type="submit">
                <div class="button-white-fill"></div>
                <div class="button-fill"></div>
                <div class="submit-text">LOGIN</div>
            </button>
            <a href="/recovery.php">Nie pamiętam hasła</a>
        </form>
        <?php
        if(isset($_SESSION['errorname'])) {
            echo "<div class='errbox'>".
            "<img src='img/error.png' alt='error'>".
            "Nie znaleziono gracza z podaną nazwą!".
            "</div>";
            unset($_SESSION['errorname']);
        }
        else if(isset($_SESSION['errorpass'])) {
            echo "<div class='errbox'>".
            "<img src='img/error.png' alt='error'>".
            "Niepoprawne hasło!".
            "</div>";
            unset($_SESSION['errorpass']);
        }
        else if(isset($_SESSION['newpass'])) {
            echo "<div class='errbox'>".
            "<img src='img/success.png' alt='error'>".
            "Ustawiono nowe hasło!".
            "</div>";
            unset($_SESSION['newpass']);
        }
        else if(isset($_SESSION['logged'])) {
            header('Location: index.php');
        }
        ?>
    </body>
</html>