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
    <title>BlackMC - Error</title>
    
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
        <h1>Błąd <span>404</span></h1>
        <h2>Strona nie znaleziona</h2>
        <p>Przepraszamy ale strona, której szukasz nie istnieje.</p>
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