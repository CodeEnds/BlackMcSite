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
    <title>BlackMC - Sklep</title>
    
    <link rel="stylesheet" href="css/shop.min.css">
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
        <div class="shop-container">
            <div class="shop-section-caption">KRYSZTAŁY</div>
            <div class="shop-section">
                <div class="shopping-card">
                    <div class="card-img gems-100">
                        <div class="card-desc">Klejnoty na serwerze BlackMC można wykorzystać do zakupu monet, skrzynek oraz przedmiotów. Wszystkie z wymienionych rzeczy są dostępne po wpisaniu /sklepremium.</div>
                    </div>
                    <div class="card-info">
                        <div class="price">10zł</div>
                        <div class="buy-buttons">
                            <form action="buy.php">
                                <input name="order" type="text" value="1" hidden>
                                <button class="buy-button">Kup</button>
                            </form>
                            <form action="buypsc.php">
                                <input name="order" type="text" value="1" hidden>
                                <button class="buy-button">Kup PSC</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="shopping-card">
                    <div class="card-img gems-200">
                        <div class="card-desc">Klejnoty na serwerze BlackMC można wykorzystać do zakupu monet, skrzynek oraz przedmiotów. Wszystkie z wymienionych rzeczy są dostępne po wpisaniu /sklepremium.</div>
                    </div>
                    <div class="card-info">
                        <div class="price">20zł</div>
                        <div class="buy-buttons">
                            <form action="buy.php">
                                <input name="order" type="text" value="2" hidden>
                                <button class="buy-button">Kup</button>
                            </form>
                            <form action="buypsc.php">
                                <input name="order" type="text" value="2" hidden>
                                <button class="buy-button">Kup PSC</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="shopping-card">
                    <div class="card-img gems-500">
                        <div class="card-desc">Klejnoty na serwerze BlackMC można wykorzystać do zakupu monet, skrzynek oraz przedmiotów. Wszystkie z wymienionych rzeczy są dostępne po wpisaniu /sklepremium.</div>
                    </div>
                    <div class="card-info">
                        <div class="price">50zł</div>
                        <div class="buy-buttons">
                            <form action="buy.php">
                                <input name="order" type="text" value="3" hidden>
                                <button class="buy-button">Kup</button>
                            </form>
                            <form action="buypsc.php">
                                <input name="order" type="text" value="3" hidden>
                                <button class="buy-button">Kup PSC</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="shopping-card">
                    <div class="card-img gems-1000">
                        <div class="card-desc">Klejnoty na serwerze BlackMC można wykorzystać do zakupu monet, skrzynek oraz przedmiotów. Wszystkie z wymienionych rzeczy są dostępne po wpisaniu /sklepremium.</div>
                    </div>
                    <div class="card-info">
                        <div class="price">100zł</div>
                        <div class="buy-buttons">
                            <form action="buy.php">
                                <input name="order" type="text" value="4" hidden>
                                <button class="buy-button">Kup</button>
                            </form>
                            <form action="buypsc.php">
                                <input name="order" type="text" value="4" hidden>
                                <button class="buy-button">Kup PSC</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="shopping-card">
                    <div class="card-img gems-2000">
                        <div class="card-desc">Klejnoty na serwerze BlackMC można wykorzystać do zakupu monet, skrzynek oraz przedmiotów. Wszystkie z wymienionych rzeczy są dostępne po wpisaniu /sklepremium.</div>
                    </div>
                    <div class="card-info">
                        <div class="price">200zł</div>
                        <div class="buy-buttons">
                            <form action="buy.php">
                                <input name="order" type="text" value="5" hidden>
                                <button class="buy-button">Kup</button>
                            </form>
                            <form action="buypsc.php">
                                <input name="order" type="text" value="5" hidden>
                                <button class="buy-button">Kup PSC</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="shop-section-caption">RANGI</div>
            <div class="shop-section">
                <div class="shopping-card">
                    <div class="card-img rank-epic">
                        <div class="card-desc">Ranga EPICKA na serwerze BlackMC daje dostęp do różnych komend, które można sprawdzić pod /ranga-epicka</div>
                    </div>
                    <div class="card-info">
                        <div class="price">10-30zł</div>
                        <div class="buy-buttons">
                            <form action="buy.php">
                                <input name="order" type="text" value="11" hidden>
                                <button class="buy-button">Kup</button>
                            </form>
                            <form action="buypsc.php">
                                <input name="order" type="text" value="11" hidden>
                                <button class="buy-button">Kup PSC</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="shopping-card">
                    <div class="card-img rank-elite">
                        <div class="card-desc">Ranga ELITARNA na serwerze BlackMC daje dostęp do różnych komend, które można sprawdzić pod /ranga-elitarna</div>
                    </div>
                    <div class="card-info">
                        <div class="price">20-50zł</div>
                        <div class="buy-buttons">
                            <form action="buy.php">
                                <input name="order" type="text" value="12" hidden>
                                <button class="buy-button">Kup</button>
                            </form>
                            <form action="buypsc.php">
                                <input name="order" type="text" value="12" hidden>
                                <button class="buy-button">Kup PSC</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="shopping-card">
                    <div class="card-img rank-mythic">
                        <div class="card-desc">Ranga MITYCZNA na serwerze BlackMC daje dostęp do różnych komend, które można sprawdzić pod /ranga-mityczna</div>
                    </div>
                    <div class="card-info">
                        <div class="price">30-70zł</div>
                        <div class="buy-buttons">
                            <form action="buy.php">
                                <input name="order" type="text" value="13" hidden>
                                <button class="buy-button">Kup</button>
                            </form>
                            <form action="buypsc.php">
                                <input name="order" type="text" value="13" hidden>
                                <button class="buy-button">Kup PSC</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="shopping-card">
                    <div class="card-img rank-legendary">
                        <div class="card-desc">Ranga LEGENDARNA na serwerze BlackMC daje dostęp do różnych komend, które można sprawdzić pod /ranga-legendarna</div>
                    </div>
                    <div class="card-info">
                        <div class="price">50-200zł</div>
                        <div class="buy-buttons">
                            <form action="buy.php">
                                <input name="order" type="text" value="14" hidden>
                                <button class="buy-button">Kup</button>
                            </form>
                            <form action="buypsc.php">
                                <input name="order" type="text" value="14" hidden>
                                <button class="buy-button">Kup PSC</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="shop-section-caption">UNBAN</div>
            <div class="shop-section">
                <div class="shopping-card">
                    <div class="card-img unban">
                        <div class="card-desc">UNBAN umożliwia wejście graczowi zbanowanemu na serwer. Usługa nie zwalnia z przestrzegania regulaminu.</div>
                    </div>
                    <div class="card-info">
                        <div class="price">10zł</div>
                        <div class="buy-buttons">
                            <form action="buy.php">
                                <input name="order" type="text" value="20" hidden>
                                <button class="buy-button">Kup</button>
                            </form>
                            <form action="buypsc.php">
                                <input name="order" type="text" value="20" hidden>
                                <button class="buy-button">Kup PSC</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
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