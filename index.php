<?php
    session_start();
    $mysql_connection = new mysqli('#', '#', '#', '#');
    if ($mysql_connection -> connect_errno) {
        exit();
   }
   $query = "SELECT * FROM luckperms_user_permissions, luckperms_players WHERE luckperms_user_permissions.uuid = luckperms_players.uuid AND luckperms_user_permissions.permission = 'sk.pin'";
   $result = $mysql_connection->query($query);
   $query2 = "SELECT * FROM luckperms_user_permissions, luckperms_players WHERE luckperms_user_permissions.uuid = luckperms_players.uuid AND luckperms_user_permissions.permission = 'sk.mod'";
   $result2 = $mysql_connection->query($query2);
   $query6 = "SELECT * FROM luckperms_user_permissions, luckperms_players WHERE luckperms_user_permissions.uuid = luckperms_players.uuid AND luckperms_user_permissions.permission = 'sk.budowniczy'";
   $result6 = $mysql_connection->query($query6);
   $query3 = "SELECT DISTINCT * FROM luckperms_user_permissions, luckperms_players WHERE luckperms_user_permissions.uuid = luckperms_players.uuid AND (luckperms_user_permissions.permission = 'sk.helperplus' OR luckperms_user_permissions.permission = 'group.helper' OR luckperms_user_permissions.permission = 'group.wstepnyhelper')";
   $result3 = $mysql_connection->query($query3);

    $h = fsockopen("blackmc.com.pl", 25565, $errno, $errstr, 3);
    fwrite($h, "\xFE");
    $data = fread($h, 1024);
    $dataArray = explode("\xA7", $data);
?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="Serwer minecraft - survival + RPG. IP: blackmc.com.pl">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/favicon.ico">
    <title>BlackMC - Serwer minecraft survival + RPG</title>
    
    <link rel="stylesheet" href="css/main.min.css">
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
        <svg id="logo-title" viewBox="0 0 772 110" fill="none" xmlns="http://www.w3.org/2000/svg">
            <mask id="path-1-outside-1_255_4" maskUnits="userSpaceOnUse" x="0" y="0" width="772" height="110" fill="black">
            <rect fill="white" width="772" height="110"/>
            <path d="M46.248 98.6H9V10.28H46.248C52.8187 10.28 58.4933 11.1333 63.272 12.84C68.136 14.4613 71.6773 16.296 73.896 18.344C76.1147 20.392 77.864 22.9093 79.144 25.896C80.424 28.7973 81.1067 30.9307 81.192 32.296C81.3627 33.6613 81.448 35.1547 81.448 36.776C81.448 42.152 79.6133 46.9307 75.944 51.112C82.856 56.0613 86.312 62.504 86.312 70.44C86.312 89.2133 72.9573 98.6 46.248 98.6ZM36.52 62.888V78.376H46.632C55.9333 78.376 60.584 75.7307 60.584 70.44C60.584 67.624 59.3893 65.6613 57 64.552C54.696 63.4427 51.24 62.888 46.632 62.888H36.52ZM36.52 30.76V45.224H44.968C48.1253 45.224 50.728 44.6267 52.776 43.432C54.824 42.2373 55.848 40.36 55.848 37.8C55.848 35.496 54.7813 33.7467 52.648 32.552C50.6 31.3573 47.9973 30.76 44.84 30.76H36.52Z"/>
            <path d="M174.442 98.6H114.154V10.28H141.674V78.376H174.442V98.6Z"/>
            <path d="M264.73 10.28L298.01 98.6H269.338L264.218 81.064H237.594L232.474 98.6H203.674L237.082 10.28H264.73ZM258.714 62.504L251.29 37.288H250.266L243.098 62.504H258.714Z"/>
            <path d="M358.879 29.48C354.015 29.48 350.602 31.1013 348.639 34.344C346.762 37.5867 345.823 42.6213 345.823 49.448V59.816C345.823 66.6427 346.762 71.6773 348.639 74.92C350.602 78.1627 354.015 79.784 358.879 79.784C363.402 79.784 366.516 78.376 368.223 75.56C369.93 72.744 370.783 68.8187 370.783 63.784H399.583C399.071 75.048 395.444 83.9653 388.703 90.536C381.962 97.0213 372.02 100.264 358.879 100.264C344.97 100.264 334.516 96.7227 327.519 89.64C320.522 82.5573 317.023 72.616 317.023 59.816V49.448C317.023 36.648 320.522 26.7067 327.519 19.624C334.516 12.5413 344.97 9 358.879 9C371.082 9 380.554 11.7733 387.295 17.32C394.036 22.8667 397.748 30.504 398.431 40.232H370.911C369.887 33.064 365.876 29.48 358.879 29.48Z"/>
            <path d="M456.375 10.28V40.872H457.911L476.087 10.28H506.423L477.623 50.984L510.519 98.6H479.415L457.655 61.864H456.375V98.6H428.855V10.28H456.375Z"/>
            <path d="M539.85 10.28H578.89L592.714 66.216H593.354L607.05 10.28H646.218V98.6H618.698V41.512H617.93L603.978 98.6H581.962L568.01 41.512H567.37V98.6H539.85V10.28Z"/>
            <path d="M721.364 29.48C716.5 29.48 713.087 31.1013 711.124 34.344C709.247 37.5867 708.308 42.6213 708.308 49.448V59.816C708.308 66.6427 709.247 71.6773 711.124 74.92C713.087 78.1627 716.5 79.784 721.364 79.784C725.887 79.784 729.001 78.376 730.708 75.56C732.415 72.744 733.268 68.8187 733.268 63.784H762.068C761.556 75.048 757.929 83.9653 751.188 90.536C744.447 97.0213 734.505 100.264 721.364 100.264C707.455 100.264 697.001 96.7227 690.004 89.64C683.007 82.5573 679.508 72.616 679.508 59.816V49.448C679.508 36.648 683.007 26.7067 690.004 19.624C697.001 12.5413 707.455 9 721.364 9C733.567 9 743.039 11.7733 749.78 17.32C756.521 22.8667 760.233 30.504 760.916 40.232H733.396C732.372 33.064 728.361 29.48 721.364 29.48Z"/>
            </mask>
            <path d="M46.248 98.6H9V10.28H46.248C52.8187 10.28 58.4933 11.1333 63.272 12.84C68.136 14.4613 71.6773 16.296 73.896 18.344C76.1147 20.392 77.864 22.9093 79.144 25.896C80.424 28.7973 81.1067 30.9307 81.192 32.296C81.3627 33.6613 81.448 35.1547 81.448 36.776C81.448 42.152 79.6133 46.9307 75.944 51.112C82.856 56.0613 86.312 62.504 86.312 70.44C86.312 89.2133 72.9573 98.6 46.248 98.6ZM36.52 62.888V78.376H46.632C55.9333 78.376 60.584 75.7307 60.584 70.44C60.584 67.624 59.3893 65.6613 57 64.552C54.696 63.4427 51.24 62.888 46.632 62.888H36.52ZM36.52 30.76V45.224H44.968C48.1253 45.224 50.728 44.6267 52.776 43.432C54.824 42.2373 55.848 40.36 55.848 37.8C55.848 35.496 54.7813 33.7467 52.648 32.552C50.6 31.3573 47.9973 30.76 44.84 30.76H36.52Z" stroke="white" stroke-width="18" mask="url(#path-1-outside-1_255_4)"/>
            <path d="M174.442 98.6H114.154V10.28H141.674V78.376H174.442V98.6Z" stroke="white" stroke-width="18" mask="url(#path-1-outside-1_255_4)"/>
            <path d="M264.73 10.28L298.01 98.6H269.338L264.218 81.064H237.594L232.474 98.6H203.674L237.082 10.28H264.73ZM258.714 62.504L251.29 37.288H250.266L243.098 62.504H258.714Z" stroke="white" stroke-width="18" mask="url(#path-1-outside-1_255_4)"/>
            <path d="M358.879 29.48C354.015 29.48 350.602 31.1013 348.639 34.344C346.762 37.5867 345.823 42.6213 345.823 49.448V59.816C345.823 66.6427 346.762 71.6773 348.639 74.92C350.602 78.1627 354.015 79.784 358.879 79.784C363.402 79.784 366.516 78.376 368.223 75.56C369.93 72.744 370.783 68.8187 370.783 63.784H399.583C399.071 75.048 395.444 83.9653 388.703 90.536C381.962 97.0213 372.02 100.264 358.879 100.264C344.97 100.264 334.516 96.7227 327.519 89.64C320.522 82.5573 317.023 72.616 317.023 59.816V49.448C317.023 36.648 320.522 26.7067 327.519 19.624C334.516 12.5413 344.97 9 358.879 9C371.082 9 380.554 11.7733 387.295 17.32C394.036 22.8667 397.748 30.504 398.431 40.232H370.911C369.887 33.064 365.876 29.48 358.879 29.48Z" stroke="white" stroke-width="18" mask="url(#path-1-outside-1_255_4)"/>
            <path d="M456.375 10.28V40.872H457.911L476.087 10.28H506.423L477.623 50.984L510.519 98.6H479.415L457.655 61.864H456.375V98.6H428.855V10.28H456.375Z" stroke="white" stroke-width="18" mask="url(#path-1-outside-1_255_4)"/>
            <path d="M539.85 10.28H578.89L592.714 66.216H593.354L607.05 10.28H646.218V98.6H618.698V41.512H617.93L603.978 98.6H581.962L568.01 41.512H567.37V98.6H539.85V10.28Z" stroke="white" stroke-width="18" mask="url(#path-1-outside-1_255_4)"/>
            <path d="M721.364 29.48C716.5 29.48 713.087 31.1013 711.124 34.344C709.247 37.5867 708.308 42.6213 708.308 49.448V59.816C708.308 66.6427 709.247 71.6773 711.124 74.92C713.087 78.1627 716.5 79.784 721.364 79.784C725.887 79.784 729.001 78.376 730.708 75.56C732.415 72.744 733.268 68.8187 733.268 63.784H762.068C761.556 75.048 757.929 83.9653 751.188 90.536C744.447 97.0213 734.505 100.264 721.364 100.264C707.455 100.264 697.001 96.7227 690.004 89.64C683.007 82.5573 679.508 72.616 679.508 59.816V49.448C679.508 36.648 683.007 26.7067 690.004 19.624C697.001 12.5413 707.455 9 721.364 9C733.567 9 743.039 11.7733 749.78 17.32C756.521 22.8667 760.233 30.504 760.916 40.232H733.396C732.372 33.064 728.361 29.48 721.364 29.48Z" stroke="white" stroke-width="18" mask="url(#path-1-outside-1_255_4)"/>
        </svg>


        <div class="copy-ip">IP: <span id="copy" onclick="copyToClipboard('#copy')">BLACKMC.COM.PL</span></div>
        <div class="copy-info">
            <img class="mouse-click" src="img/mouse-click.png" alt="Kliknięcie myszą"> aby skopiować
        </div>

        <div class="server-status">
            <div class="server-status-icon <?php echo $dataArray['1'] == "" ? "offline" : "online"; ?>">
                <div class="wave"></div>
                <div class="wave"></div>
            </div>
            <div class="server-status-info">Graczy online: <span class="playercount"><?php echo $dataArray['1'] == "" ? "0/100" : $dataArray['1']."/".$dataArray['2'] ?></span></div>
        </div>

    </main>

    <section class="moderation">
        <div class="background-arrow"></div>
        <div class="background-title">ADMINISTRACJA</div>

        <div class="mod-container">
            <div class="mod-section">
                <div class="section-content">
                    <?php
                    while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="mod-card">
                        <div class="card-skin"></div>
                        <div class="card-info">
                            <div class="card-info-name"><?php echo strtoupper($row['username']);?></div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="section-caption">ADMINI</div>
            </div>
            <div class="mod-section">
                <div class="section-content">
                    <?php
                     while($row = $result2->fetch_assoc()) {
                    ?>
                    <div class="mod-card">
                        <div class="card-skin"></div>
                        <div class="card-info">
                            <div class="card-info-name"><?php echo strtoupper($row['username']);?></div>
                        </div>
                    </div>
                    <?php
                    } 
                    ?>
                </div>
                <div class="section-caption">MODERATORZY</div>
            </div>
            <div class="mod-section">
                <div class="section-content">
                    <?php
                     while($row = $result3->fetch_assoc()) {
                    ?>
                    <div class="mod-card">
                        <div class="card-skin"></div>
                        <div class="card-info">
                            <div class="card-info-name"><?php echo strtoupper($row['username']);?></div>
                        </div>
                    </div>
                    <?php
                    } 
                    ?>
                </div>
                <div class="section-caption">HELPERZY</div>
            </div>
            <div class="mod-section">
                <div class="section-content">
                <?php
                     while($row = $result6->fetch_assoc()) {
                    ?>
                    <div class="mod-card">
                        <div class="card-skin"></div>
                        <div class="card-info">
                            <div class="card-info-name"><?php echo strtoupper($row['username']);?></div>
                        </div>
                    </div>
                    <?php
                    } 
                    ?>
                </div>
                <div class="section-caption">BUDOWNICZY</div>
            </div>
        </div>
    </section>

    <section class="playertop">
        <div class="top">
            <div class="title">TOPKI</div>
            <div class="content">
                <div class="categories">
                    <button onclick="changeLeaderboard('level')">POZIOM</button>
                    <button onclick="changeLeaderboard('time')">CZAS</button>
                    <button onclick="changeLeaderboard('money')">MONETY</button>
                    <button onclick="changeLeaderboard('kills')">ZABÓJSTWA</button>
                    <button onclick="changeLeaderboard('deaths')">ŚMIERCI</button>
                    <button onclick="changeLeaderboard('moneywebsite')">WYDANE PIENIĄDZE</button>
                </div>
                <!-- <div class="player-search">
                    <form class="search-bar">
                        <input placeholder="Wyszukaj gracza" type="text" class="search">
                        <button type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div> -->
            </div>
        </div>
        <div class="bottom">
            <div class="left">
                <div class="card-slot">
                    <img src="img/empty-slot-icon.png" alt="Ikona pustego slotu">
                </div>
                <div nick="<?php echo isset($_SESSION['logged']) ? $_SESSION['name'] : "" ?>" class="profile-card profile-card-1">
                    <div class="profile-header">
                        <button class="profile-remove" onclick="leftProfileCard.changeProfile('')">
                            <img src="img/error.png" alt="X">
                        </button>
                        <div class="profile-avatar">
                            <canvas width="64" height="64"></canvas>
                        </div>
                        <div class="profile-name"></div>
                        <div class="profile-rank"></div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-level profile-record">
                            Poziom:
                            <div class="value"></div>
                            <div class="profile-exp">
                                <div class="progress-info">
                                    <div class="value"></div>
                                    <div class="max-value"></div>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill"></div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-kills profile-record">
                            Zabójstwa:
                            <div class="value"></div>
                            <img src="img/icons/kills-icon.png" alt="Ikona zabójstw">
                        </div>
                        <div class="profile-deaths profile-record">
                            Śmierci:
                            <div class="value"></div>
                            <img src="img/icons/deaths-icon.png" alt="Ikona śmierci">
                        </div>
                        <div class="profile-time profile-record">
                            Czas na serwerze:
                            <div class="value"></div>
                            <img src="img/icons/time-icon.png" alt="Ikona czasu na serwerze">
                        </div>
                        <div class="profile-money profile-record">
                            Monety:
                            <div class="value"></div>
                            <img src="img/icons/money-icon.png" alt="Ikona monet">
                        </div>
                        <div class="profile-moneywebsite profile-record">
                            Wydane pieniądze:
                            <div class="value"></div>
                            <img src="img/icons/moneywebsite-icon.png" alt="Ikona wydanych pieniędzy">
                        </div>
                    </div>
                </div>
            </div>
            <div class="middle">
                <div class="leaderboard">
                    <div class="leaderboard-top">
                        <div class="top3">
                            <div class="player-record">
                                <div class="player-skin">
                                    <canvas width="64" height="64" class="avatar"></canvas>
                                </div>
                                <div class="player-name">Steve</div>
                                <div class="score"></div>
                                <img src="img/trophy-2.png" alt="2 Miejsce">
                            </div>
                            <div class="player-record">
                                <div class="player-skin">
                                    <canvas width="64" height="64" class="avatar"></canvas>
                                </div>
                                <div class="player-name">Steve</div>
                                <div class="score"></div>
                                <img src="img/trophy-1.png" alt="1 Miejsce">
                            </div>
                            <div class="player-record">
                                <div class="player-skin">
                                    <canvas width="64" height="64" class="avatar"></canvas>
                                </div>
                                <div class="player-name">Steve</div>
                                <div class="score"></div>
                                <img src="img/trophy-3.png" alt="3 Miejsce">
                            </div>
                        </div>
                    </div>
                    <div class="leaderboard-bottom">
                        <div class="top10">
                            <div class="player-record">
                                <div class="place">4</div>
                                <div class="head">
                                    <canvas width="64" height="64" class="avatar"></canvas>
                                </div>
                                <div class="player-name">Steve</div>
                                <div class="score">0</div>
                            </div>
                            <div class="player-record">
                                <div class="place">5</div>
                                <div class="head">
                                    <canvas width="64" height="64" class="avatar"></canvas>
                                </div>
                                <div class="player-name">Steve</div>
                                <div class="score">0</div>
                            </div>
                            <div class="player-record">
                                <div class="place">6</div>
                                <div class="head">
                                    <canvas width="64" height="64" class="avatar"></canvas>
                                </div>
                                <div class="player-name">Steve</div>
                                <div class="score">0</div>
                            </div>
                            <div class="player-record">
                                <div class="place">7</div>
                                <div class="head">
                                    <canvas width="64" height="64" class="avatar"></canvas>
                                </div>
                                <div class="player-name">Steve</div>
                                <div class="score">0</div>
                            </div>
                            <div class="player-record">
                                <div class="place">8</div>
                                <div class="head">
                                    <canvas width="64" height="64" class="avatar"></canvas>
                                </div>
                                <div class="player-name">Steve</div>
                                <div class="score">0</div>
                            </div>
                            <div class="player-record">
                                <div class="place">9</div>
                                <div class="head">
                                    <canvas width="64" height="64" class="avatar"></canvas>
                                </div>
                                <div class="player-name">Steve</div>
                                <div class="score">0</div>
                            </div>
                            <div class="player-record">
                                <div class="place">10</div>
                                <div class="head">
                                    <canvas width="64" height="64" class="avatar"></canvas>
                                </div>
                                <div class="player-name">Steve</div>
                                <div class="score">0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="card-slot">
                    <img src="img/empty-slot-icon.png" alt="Ikona pustego slotu">
                </div>
                <div nick="" class="profile-card profile-card-2">
                    <div class="profile-header">
                        <button class="profile-remove" onclick="rightProfileCard.changeProfile('')">
                            <img src="img/error.png" alt="X">
                        </button>
                        <div class="profile-avatar">
                            <canvas width="64" height="64"></canvas>
                        </div>
                        <div class="profile-name"></div>
                        <div class="profile-rank"></div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-level profile-record">
                            Poziom:
                            <div class="value"></div>
                            <div class="profile-exp">
                                <div class="progress-info">
                                    <div class="value"></div>
                                    <div class="max-value"></div>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill"></div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-kills profile-record">
                            Zabójstwa:
                            <div class="value"></div>
                            <img src="img/icons/kills-icon.png" alt="Ikona zabójstw">
                        </div>
                        <div class="profile-deaths profile-record">
                            Śmierci:
                            <div class="value"></div>
                            <img src="img/icons/deaths-icon.png" alt="Ikona śmierci">
                        </div>
                        <div class="profile-time profile-record">
                            Czas na serwerze:
                            <div class="value"></div>
                            <img src="img/icons/time-icon.png" alt="Ikona czasu na serwerze">
                        </div>
                        <div class="profile-money profile-record">
                            Monety:
                            <div class="value"></div>
                            <img src="img/icons/money-icon.png" alt="Ikona monet">
                        </div>
                        <div class="profile-moneywebsite profile-record">
                            Wydane pieniądze:
                            <div class="value"></div>
                            <img src="img/icons/moneywebsite-icon.png" alt="Ikona wydanych pieniędzy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="credits">
                <img src="img/logo.png" alt="LOGO BLACKMC">
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

    <div id="box_message" class="first" style="display: none; opacity: 0;">IP zostało skopiowane.</div>

    <script>
        AOS.init();
    </script>
    <script src="js/clipboard.js"></script>
    <script src="js/navbar-collapse.js"></script>
    <script src="js/skinview3d.bundle.js"></script>
    <script src="js/loader.js"></script>
    <script src="js/selectFix.js"></script>
    <script src="js/administration.js"></script>
    <script src="js/skinDisplay.js"></script>
    <script src="js/profileDropdown.js"></script>
    <script src="js/logoAnimEnd.js"></script>
    <script src="js/pfp.js"></script>
    <script src="js/leaderboard.js"></script>
    <script src="js/profileCards.js"></script>

</body>
</html>