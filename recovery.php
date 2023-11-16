<?php
session_start();
if(isset($_SESSION['logged'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="css/logowanie.min.css">
    </head>
    <body>
        <form action="verifymail.php" method="POST">
            <p class="title">Odzyskiwanie hasła</p>
            <input type="email" name="email" placeholder="e-mail">
            <input type="text" name="name" placeholder="nazwa">
            <button type="submit">
                <div class="button-white-fill"></div>
                <div class="button-fill"></div>
                <div class="submit-text">WYŚLIJ</div>
            </button>
        </form>
        <?php
        if(isset($_SESSION['erroremail']))
        {
            echo "<div class='errbox'>".
            "<img src='img/error.png' alt='error'>".
            $_SESSION['erroremail'].
            "</div>";
            unset($_SESSION['erroremail']);
            exit();
        }
        ?>
    </body>
</html>