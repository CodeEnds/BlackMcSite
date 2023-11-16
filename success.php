<?php
use Thedudeguy\Rcon;

$mysql_connection = new mysqli('#', '#', '#', '#');
if ($mysql_connection -> connect_errno) {
    exit();
}
if (!$mysql_connection->set_charset("utf8")) {
    echo "Błąd ustawienia zestawu znaków: %s\n", $mysql_connection->error;
    exit();
}

/*
$_POST["KWOTA"] - wartość płatności     
$_POST["ID_PLATNOSCI"] - unikalne id płatności
$_POST["ID_ZAMOWIENIA"] - id zamówienia podane podczas inicjacji               
$_POST["STATUS"] - FAILURE / SUCCESS / PENDING
$_POST["SEKRET"] - sekret danej usługi
$_POST["SECURE"] - oznaczenie bezpiecznej transakcji
$_POST["HASH"] - hash funkcji skrótu sha256, składającej się z hash("sha256","HASLOZUSTAWIEN;".$_POST["KWOTA"].";".$_POST["ID_PLATNOSCI"].";".$_POST["ID_ZAMOWIENIA"].";".$_POST["STATUS"].";".$_POST["SECURE"].";".$_POST["SEKRET"])
*/                      
if(!empty($_POST)){
    if(!empty($_POST["KWOTA"]) &&
        !empty($_POST["ID_PLATNOSCI"]) &&
        !empty($_POST["ID_ZAMOWIENIA"]) &&
        !empty($_POST["STATUS"]) &&
        !empty($_POST["SEKRET"]) &&
        !empty($_POST["SECURE"]) &&
        !empty($_POST["HASH"])
    ){
        if(hash("sha256","Blackmc123;".$_POST["KWOTA"].";".$_POST["ID_PLATNOSCI"].";".$_POST["ID_ZAMOWIENIA"].";".$_POST["STATUS"].";".$_POST["SECURE"].";".$_POST["SEKRET"]) == $_POST["HASH"]){
            //komunikacja poprawna
            if($_POST["STATUS"]=="SUCCESS") {
                require_once('Rcon.php');
                $host = "34.116.153.231";            // Server host name or IP
                $port = 24955;                      // Port rcon is listening on
                $password = '#';      // rcon.password setting set in server.properties
                $timeout = 3;                       // How long to timeout.
                $rcon = new Rcon($host, $port, $password, $timeout);
                if($rcon->connect()) {
                    $id = $_POST["ID_ZAMOWIENIA"] - 1;
                    $query = "SELECT * FROM hotpay_przelewy WHERE id=".$id;
                    $result = $mysql_connection->query($query);
                    if($result->num_rows == 0) {
                        header('Location:success.php');
                        $_SESSION['noRowFoundErr'] = true;
                        exit();
                    }
                    while($row = $result->fetch_assoc()) {
                        if($row['status'] == "Zakonczono") {
                            header('Location:index.php');
                            exit();
                        } 
                        $updateQuery = "UPDATE hotpay_przelewy SET status='Zakonczono' WHERE id=$id";
                        $nick = $row['nick'];
                        $selectMoney = "SELECT moneywebsite FROM stats WHERE username='".$nick."' ORDER BY id DESC LIMIT 1";
                        $executeQuery = $mysql_connection->query($selectMoney);
                        while($resultRow = $executeQuery->fetch_assoc()) {
                            $baseMoney = $resultRow['moneywebsite'];
                            $moneyToAdd = $row['price'];
                            $baseMoney += $moneyToAdd;
                            $updateSpentMoney = "UPDATE stats SET moneywebsite=$baseMoney WHERE username='".$nick."'";
                            $mysql_connection->query($updateSpentMoney);
                        }
                        if(!$mysql_connection->query($updateQuery)) {
                            header('Location:success.php');
                            $_SESSION['updateQueryErr'] = true;
                            exit();
                        }
                        if($row['service'] == "100 klejnotów") {
                            $rcon->sendCommand("gemsgive ".$row['nick']." 100");
                            $_SESSION['success'] = true;
                        } else if($row['service'] == "200 klejnotów") {
                            $rcon->sendCommand("gemsgive ".$row['nick']." 200");
                            $_SESSION['success'] = true;
                        }
                        else if($row['service'] == "500 klejnotów") {
                            $rcon->sendCommand("gemsgive ".$row['nick']." 500");
                            $_SESSION['success'] = true;
                        }
                        else if($row['service'] == "1000 klejnotów") {
                            $rcon->sendCommand("gemsgive ".$row['nick']." 1000");
                            $_SESSION['success'] = true;
                        }
                        else if($row['service'] == "2000 klejnotów") {
                            $rcon->sendCommand("gemsgive ".$row['nick']." 2000");
                            $_SESSION['success'] = true;
                        }
                        else if($row['service'] == "UNBAN") {
                            $rcon->sendCommand("pardon ".$row['nick']);
                            $rcon->sendCommand("pardonip ".$row['nick']);
                            $_SESSION['success'] = true;
                        }
                        else if($row['service'] == "ranga EPICKA") {
                            if($row['period'] == "1 miesiąc") {
                                $rcon->sendCommand("lp user ".$row['nick']." parent addtemp epicki 30d");
                                $_SESSION['success'] = true;
                            } else if($row['period'] == "3 miesiące") {
                                $rcon->sendCommand("lp user ".$row['nick']." parent addtemp epicki 90d");
                                $_SESSION['success'] = true;
                            } else if($row['period'] == "Na zawsze") {
                                $rcon->sendCommand("lp user ".$row['nick']." parent add epicki");
                                $_SESSION['success'] = true;
                            }
                        }
                        else if($row['service'] == "ranga ELITARNA") {
                            if($row['period'] == "1 miesiąc") {
                                $rcon->sendCommand("lp user ".$row['nick']." parent addtemp elita 30d");
                                $_SESSION['success'] = true;
                            } else if($row['period'] == "3 miesiące") {
                                $rcon->sendCommand("lp user ".$row['nick']." parent addtemp elita 90d");
                                $_SESSION['success'] = true;
                            } else if($row['period'] == "Na zawsze") {
                                $rcon->sendCommand("lp user ".$row['nick']." parent add elita");
                                $_SESSION['success'] = true;
                            }
                        }
                        else if($row['service'] == "ranga MITYCZNA") {
                            if($row['period'] == "1 miesiąc") {
                                $rcon->sendCommand("lp user ".$row['nick']." parent addtemp mityczny 30d");
                                $_SESSION['success'] = true;
                            } else if($row['period'] == "3 miesiące") {
                                $rcon->sendCommand("lp user ".$row['nick']." parent addtemp mityczny 90d");
                                $_SESSION['success'] = true;
                            } else if($row['period'] == "Na zawsze") {
                                $rcon->sendCommand("lp user ".$row['nick']." parent add mityczny");
                                $_SESSION['success'] = true;
                            }
                        }
                        else if($row['service'] == "ranga LEGENDARNA") {
                            if($row['period'] == "1 miesiąc") {
                                $rcon->sendCommand("lp user ".$row['nick']." parent addtemp legenda 30d");
                                $_SESSION['success'] = true;
                            } else if($row['period'] == "3 miesiące") {
                                $rcon->sendCommand("lp user ".$row['nick']." parent addtemp legenda 90d");
                                $_SESSION['success'] = true;
                            } else if($row['period'] == "Na zawsze") {
                                $rcon->sendCommand("lp user ".$row['nick']." parent add legenda");
                                $_SESSION['success'] = true;
                            }
                        }
                    }     
                } 
            }  else if($_POST["STATUS"]=="FAILURE"){
                $_SESSION['failure'] = true;
                header('Location:success.php');
                exit();
                
            } else if($_POST["STATUS"]=="PENDING"){
                //odrzucone
                $_SESSION['pending'] = true;
                
            }
        }
    }
    } else {
        header('Location:index.php');
        exit();
    }
?>
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/favicon.ico">
    <title>BlackMC - Status Zakupu</title>
    
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
        if(isset($_SESSION['noRowFoundErr'])) {
            unset($_SESSION['noRowFoundErr']);
            echo "<h1>Nieznany błąd! Zgłoś się do administracji serwera!</h1>";
        } else if(isset($_SESSION['updateQueryErr'])) {
            unset($_SESSION['updateQueryErr']);
            echo "<h1>Nieznany błąd! Zgłoś się do administracji serwera!</h1>";
        } else if(isset($_SESSION['success'])) {
            unset($_SESSION['success']);
            echo "<h1>Udało Ci się dokonać zakupu!</h1>";
            echo "<h2>W razie problemów zgłoś się do administracji</h2>";
        } else if(isset($_SESSION['failure'])) {
            unset($_SESSION['failure']);
            echo "<h1>Błąd podczas dokonywania płatności!</h1>";
        } 
        else if(isset($_SESSION['pending'])) {
            unset($_SESSION['pending']);
            echo "<h1>Oczekiwanie na płatność...</h1>";
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