<?php
session_start();
$mysql_connection = new mysqli('#', '#', '#', '#');
$order = $_GET['order'];
$info = $_SESSION['info'];
if ($mysql_connection -> connect_errno) {
    exit();
}
if (!$mysql_connection->set_charset("utf8")) {
    echo "Błąd ustawienia zestawu znaków: %s\n", $mysql_connection->error;
    exit();
}
$query = $mysql_connection->query("SELECT * FROM services WHERE id=$order");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/favicon.ico">
    <title>BlackMC - Sklep</title>
    
    <link rel="stylesheet" href="css/buy.min.css">
    <link rel="stylesheet" href="css/aos.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="js/aos.min.js"></script>
    <script src="https://kit.fontawesome.com/3461784b2e.js" crossorigin="anonymous"></script>

    <script src="js/showpass.js"></script>

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
        while($row = $query->fetch_assoc()) {
        ?>
        <div class="shop-container">
            <div class="left">
                <img src="<?php echo "img/".$row['id'].".jpg";?>" alt="Klejnoty">
            </div>
            <div class="right">
                <div class="info">
                    <h2><?php echo $row['title']; ?></h2>
                    <?php
                    if($order <= 5 || $order == 20) {
                    ?>
                    <h3><?php echo $row['price1']." zł";  ?></h3>
                    <?php
                    } else {
                        ?>
                        <h3><?php echo $row['price1']."-".$row['price3']." zł"; ?></h3>
                        <?php
                    }
                    ?>
                </div>
                <form action=<?php echo "validationpsc.php"; ?> method="POST">
                    <?php
                    if($order > 5 && $order < 20) {
                    ?>
                    <label for="timespan">Okres</label>
                    <select name="timespan">
                        <option value="1 miesiąc"><?php echo "1 miesiąc - ".$row['price1']." zł"; ?></option>
                        <option value="3 miesiące"><?php echo "3 miesiące - ".$row['price2']." zł"; ?></option>
                        <option value="Na zawsze"><?php echo "Na zawsze - ".$row['price3']." zł"; ?></option>
                    </select>
                    <?php
                    }
                    ?>
                    <label for="nick">Nick</label>
                    <input type="text" name="nick" value="<?php if(isset($_SESSION['name'])) echo $_SESSION['name']; ?>" required>
                    <label for="psc">Kod PaySafeCard</label>
                    <input type="text" name="psc" maxlength="16" minlength="16" required>
                    <input type="hidden" name="order" value=<?php echo $order; ?>>
                    <button type="submit">
                        <div class="button-white-fill"></div>
                        <div class="button-fill"></div>
                        <div class="submit-text">KUP</div>
                    </button>
                </form>
                <div class="terms">Kupując na tej stronie akceptujesz <a href="regulations.php">regulamin</a></div>
            </div>
        </div>
        <?php
        }
        ?>
    </main>
        
    <script src="js/loader.js"></script>
    <script src="js/profileDropdown.js"></script>
    <script src="js/pfp.js"></script>

    <?php
        if(isset($info)) {
            unset($_SESSION['info']);
            echo "<div class='errbox'>".
            "Error: $info".
            "</div>";
        }
    ?>
    </body>
</html>