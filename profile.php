<?php
    session_start();
    if(!isset($_SESSION['logged'])) {
        header('Location: index.php');
    }
    $mysql_connection = new mysqli('localhost', 'phpmyadmin', 'Blackmc123', 'phpmyadmin');
    if ($mysql_connection -> connect_errno) {
        exit();
   }
   $query = "SELECT * FROM stats WHERE username=\"".$_SESSION['name']."\"";
   $result = $mysql_connection->query($query);
?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/favicon.ico">
    <title>BlackMC - Profil</title>
    
    <link rel="stylesheet" href="css/profile.min.css">
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
        <div class="left">
            <?php
            if(isset($_SESSION['logged']))
                echo '<canvas nick="'.$_SESSION['name'].'" class="profile-skin"></canvas>';
            ?>
        </div>
        <div class="right">
        <?php
            while($row = $result->fetch_assoc()) {
                switch($row['ranga']) {
                    case "admin":
                        $rank = "<span style=\"color:red;\">ADMIN</span>";
                        break;
                    case "moderator":
                        $rank = "<span style=\"color:orange;\">MODERATOR</span>";
                        break;
                    case "budowniczy":
                        $rank = "<span style=\"color:blue;\"'>BUDOWNICZY</span>";
                        break;
                    case "helper+":
                        $rank = "<span style=\"color:#03B500;\"'>HELPER+</span>";
                        break;
                    case "helper":
                        $rank = "<span style=\"color:#05CF02;\"'>HELPER</span>";
                        break;
                    case "wstepnyhelper":
                        $rank = "<span style=\"color:#04EF00;\"'>WSTĘPNY HELPER</span>";
                        break;
                    case "legenda":
                        $rank = "<span style=\"color:#E0E700;\"'>LEGENDARNY</span>";
                        break;
                    case "mityczna":
                        $rank = "<span style=\"color:#02C8E8;\"'>MITYCZNY</span>";
                        break;
                    case "elita":
                        $rank = "<span style=\"color:#00C5DB;\"'>ELITARNY</span>";
                        break;
                    case "epicki":
                        $rank = "<span style=\"color:#4300DB;\"'>EPICKI</span>";
                        break;
                    default:
                        $rank = "<span style=\"color:gray;\">GRACZ</span>";
                }
            
            ?>
            <div class="credentials"><?php echo $row['username']." ".$rank; ?></div>
            <div class="statistics">
                <div class="statistic">
                    <div class="title">Poziom</div>
                    <div class="content">
                        <div><span><?php echo $row['level']; ?></span> poziom</div>
                        <p><?php echo $row['exp']; ?>/<?php echo $row['maxexp']; ?></p>
                        <div class="progress-bar"><div value="<?php echo $row['exp']; ?>" max-value="<?php echo $row['maxexp']; ?>" class="progress-fill"></div></div>
                    </div>
                </div>
                <div class="statistic">
                    <div class="title">Zabójstwa</div>
                    <div class="content">
                        <div><span><?php echo $row['kills']; ?></span> zabójstw na serwerze</div>
                    </div>
                </div>
                <div class="statistic">
                    <div class="title">Czas w grze</div>
                    <div class="content">
                        <div><span><?php echo $row['time']; ?> </span>minut na serwerze</div>
                    </div>
                </div>
                <div class="statistic">
                    <div class="title">Śmierci</div>
                    <div class="content">
                        <div><span><?php echo $row['deaths']; ?></span> śmierci na serwerze</div>
                    </div>
                </div>
                <div class="statistic">
                    <div class="title">Monety</div>
                    <div class="content">
                        <div><span><?php echo $row['money']; ?></span> monet na serwerze</div>
                    </div>
                </div>
                <div class="statistic">
                    <div class="title">Wydane pieniądze</div>
                    <div class="content">
                        <div><span><?php echo $row['moneywebsite']; ?> zł</span> wydanych na serwerze</div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </main>

    <script src="js/skinview3d.bundle.js"></script>
    <script src="js/loader.js"></script>
    <script src="js/profileDropdown.js"></script>
    <script src="js/profileSkinDisplay.js"></script>
    <script src="js/pfp.js"></script>
    <script src="js/progressBar.js"></script>

</body>
</html>