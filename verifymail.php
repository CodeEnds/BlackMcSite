<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

session_start();
if(isset($_SESSION['logged'])) {
    header('Location: index.php');
}
$email = $_POST['email'];
$name = $_POST['name'];
if(!isset($email)) {
    header('Location: recovery.php');
    $_SESSION['erroremail'] = "Nie podałeś żadnego e-mail'a";
    exit();
}
if(!isset($name)) {
    header('Location: recovery.php');
    $_SESSION['erroremail'] = "Nie podałeś nazwy z serwera";
    exit();
}
$mysql_connection = new mysqli('localhost', 'phpmyadmin', 'Blackmc123', 'phpmyadmin');
if ($mysql_connection -> connect_errno) {
    exit();
}
$result = $mysql_connection->query('SELECT * FROM authme WHERE username="'.$name.'" AND email="'.$email.'"');
if($result->num_rows == 0)
{
    $_SESSION['erroremail'] = "E-mail lub nazwa użytkownika jest niepoprawna";
    header('Location: recovery.php');
    exit();
}
while($row = $result->fetch_assoc())
{
    $query2 = $mysql_connection->query('SELECT * FROM token WHERE id_user='.$row['id']);
    if($query2->num_rows > 0) {
        $_SESSION['passsenterror'] = true;
    }
    else {
    $id = $row['id'];
    $username = $row['username'];
    $hashedToken = hash('sha256', $id + $username);
    $hashedTokenSubstr = substr($hashedToken, 0, 16);
    $query = $mysql_connection->query("INSERT INTO token VALUES(NULL, $id, '$hashedTokenSubstr', 20)");
    }
}
//Wysyłanie e-maila
if(!isset($_SESSION['passsenterror'])) {
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;                     
        $mail->isSMTP();        
        $mail->Timeout    =  10;                                    
        $mail->Host       = 'smtp.gmail.com';                    
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = '#';                    
        $mail->Password   = '#';                             
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('#', 'BlackMC');
        $mail->addAddress($email, 'Użytkownik');    
        $mail->addReplyTo('#');
        $mail->CharSet = "UTF-8";
        
        $mail->isHTML(true);      
        $mail->Subject = 'Odzyskiwanie hasła';
        $mail->Body = "<h1>Odzyskiwanie hasła na BlackMC</h1></br><h3>Aby ustawić nowe hasło wejdź w </br><a href='https://blackmc.com.pl/password.php?token=$hashedTokenSubstr'>ustawianie hasła</a>.</h3>
        </br>Mail jest wysyłany automatycznie. Prosimy na niego nie odpowiadać.";

        $mail->send();
        $_SESSION['successemail'] = true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/favicon.ico">
    <title>BlackMC - Weryfikacja mailu</title>
    
    <link rel="stylesheet" href="css/error.min.css">
    <link rel="stylesheet" href="css/aos.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="js/aos.min.js"></script>
    <script src="https://kit.fontawesome.com/3461784b2e.js" crossorigin="anonymous"></script>

    <script src="js/disableScroll.js"></script>
</head>
<body>

    <!-- Laoder -->

    <div class="loader_wrapper">
        <div class="loader"></div>
    </div>

    <nav>
        <div class="menu-icons">
            <div class="menu-links">
                <a href="index.php">GŁÓWNA</a>
                <a href="shop.php">SKLEP</a>
                <a href="https://discord.gg/blackmc-607489658095665192" target="_blank">DISCORD</a>
            </div>
            <div class="profile-box">
                <?php
                if(isset($_SESSION['logged'])) {
                    echo '<canvas nick="'.$_SESSION['name'].'" width="64" height="64" class="pfp"></canvas>';
                ?>
                <!--<canvas nick="F0xyg3n" width="64" height="64" class="pfp"></canvas> Wyciągnąć nazwę gracza do `nick=""` -->
                <img src="img/dropdown-arrow.png" alt="dropdown arrow">
                <div class="dropdown dropdown-hidden">
                    <?php if(isset($_SESSION['admin'])) echo "<a href='console-pin.php'>KONSOLA</a>" ?>
                    <a href='logout.php'>WYLOGUJ SIĘ</a>
                </div>
                <?php
                } else {
                ?>
                    <canvas nick="" width="64" height="64" class="pfp"></canvas>
                    <img src="img/dropdown-arrow.png" alt="dropdown arrow">
                    <div class="dropdown dropdown-hidden">
                        <a href="authme.php">ZALOGUJ SIĘ</a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </nav>

    <main>
        <?php
        if(isset($_SESSION['successemail'])) {
            echo "<h2>Link do odzyskiwania hasła został wysłany na podanego e-maila</h2>";
            unset($_SESSION['successemail']);
        } else if(isset($_SESSION['passsenterror'])) {
            echo "<h2>Link do odzyskiwania hasła został już wysłany na e-maila</h2>";
            unset($_SESSION['passsenterror']);
        }
        else {
            echo "<h2>Wystąpił nieznany błąd. Spróbuj ponownie później</h2>";
        }
        ?>
    </main>

    <footer>
        <div class="container">
            <div class="credits">
                <img src="img/blackmc.png" alt="LOGO BLACKMC">
                <div class="authors">Made by Sharyxxx <span>(backend)</span> and Foxyg3n <span>(frontend)</span></div>
            </div>
            <div class="important-links">
                <a href="regulations.php">Regulamin</a>
            </div>
            <div class="social-media">
                <a target="_blank" href="https://www.tiktok.com/@blackmc_server" class="media-icon"><svg xmlns="http://www.w3.org/2000/svg"><use xlink:href="img/icons/tiktok.svg#tiktok"/></svg></a>
                <a target="_blank" href="https://discord.gg/blackmc-607489658095665192" class="media-icon"><svg xmlns="http://www.w3.org/2000/svg"><use xlink:href="img/icons/discord.svg#discord"/></svg></a>
                <a target="_blank" href="https://www.youtube.com/@Martin-ed1tz" class="media-icon"><svg xmlns="http://www.w3.org/2000/svg"><use xlink:href="img/icons/youtube.svg#youtube"/></svg></a>
                <a target="_blank" href="https://www.facebook.com/BlackMC1.16.1" class="media-icon"><svg xmlns="http://www.w3.org/2000/svg"><use xlink:href="img/icons/facebook.svg#facebook"/></svg></a>
            </div>
        </div>
    </footer>
        
    <script src="js/loader.js"></script>
    <script src="js/profileDropdown.js"></script>
    <script src="js/pfp.js"></script>
</body>
</html>