<?php
    session_start();
    $mysql_connection = new mysqli('#', '#', '#', '#');
    $order = $_GET['order'];
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
    <title>BlackMC - Regulamin</title>
    
    <link rel="stylesheet" href="css/regulations.min.css">
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
        <div class="container">

            <h2>Regulamin zakupu w serwisie blackm.com.pl</h2>

            <h3>-Definicje-</h3>

            <p>1. <b>ADMINISTRACJA</b> - Osoby, zarządzające serwerem blackmc.com.pl</p>

            <p>2. <b>BAN</b> - Zakaz wchodzenia na serwer, ustawiany przez administrację serwera blackmc.com.pl. Zakaz ten otrzymuje osoba, która złamała regulamin, znajdujący się na serwerze blackmc.com.pl.</p>

            <p>3. <b>KONSUMENT</b> - Osoba dokonująca zakup usługi na stronie internetowej blackmc.com.pl</p>

            <p>4. <b>KONTO</b> - Konto minecraft, indentyfikowane konkretną nazwą użytkownika, używane na serwerze blackmc.com.pl</p>

            <p>5. <b>REGULAMIN</b> - Regulamin serwisu poprzedzający zakup na stronie blackmc.com.pl</p>

            <p>6. <b>SERWER</b> - Serwer minecraft umożliwiający grę z innymi osobami o domenie blackmc.com.pl</p>

            </br>

            <h3>-Postanowienia ogólne-</h3>

            <p>1. Strona o domenie blackmc.com.pl oferuje usługi na serwerze minecraft o domenie blackmc.com.pl.</p>

            <p>2. Wszystkie loga oraz grafiki zawarte na stronie są własnością serwera blackmc.com.pl i nie mogą zostać wykorzystane przez użytkowników do tego nieuprawnionych. Uprawnienie do wykorzystania grafik można uzyskać poprzez kontakt z administracją na platformie discord, bądź też przez E-MAIL: <b>bmcserwer@gmail.com</b></p>

            <p>3. Właściciel serwisu zastrzega sobie prawo do zmiany funkcjonalności strony internetowej blackmc.com.pl</p> 

            <p>4. Właściciel serwisu zastrzega sobie prawo do wprowadzania zmian w regulaminie bez informowania użytkowników o poprawkach.</p> 

            </p>5. Każdy użytkownik dokonujący zakup na stronie jest zobowiązany do zaakceptowania warunków regulaminu.</p>

            </br>

            <h3>-Informacje dotyczące oferowanych usług-</h3>

            <p>1. Usługa jest realizowa bezpośrednio po zaksięgowaniu wpłaty.</p>

            <p>2. W przypadku nieotrzymania zakupionych usług należy wysłać wiadomosć do administratora, w aplikacji discord, o nazwie: <b>Sharyxxx#7724</b>, bądź też poprzez E-MAIL: <b>bmcserwer@gmail.com</b>.</p>

            <p>3. Administracja nie ponosi odpowiedzalności za wirtualne przedmioty od chwili dodania ich na konto użytkownika.</p>

            <p>4. Administracja nie odpowiada za utratę konta/włamanie na konto, na które została zakupiona konkretna usługa/usługi. Serwer blackmc.com.pl posiada systemy zabezpieczeń uniemożliwiające uzyskanie danych logowania, bądź też dostęp do konta bez autoryzacji.</p>

            <p>5. Administracja może odmówić sprzedaży usługi i dokonać zwrot pieniędzy poprzez przelew na konto bankowe lub na konto paypal w kwocie po odjęciu prowizji.</p>

            <p>6. Osoba, która otrzyma bana, nie otrzymuję zwrotu za zakupione usługi.</p>

            </br>

            <h3>-Obowiązki konsumenta-</h3>

            <p>1. Konsument musi posiadać zarejestrowane konto na serwerze, na które otrzyma zakupioną usługę.</p>

            <p>2. Konsument jest zobowiązany do podania prawidłowych danych przy zakupie.</p>

            <p>3. Konsument jest zobowiązany do współpracy z administracją serwera blackmc.com.pl podczas realizacji usługi.</p>

            </p>4. Konsument dokonujący zakupu na stronie internetowej blackmc.com.pl jest zobowiązany do zaakceptowania warunków regulaminu.</p>

            </br>

            <h3>-Reklamacja-</h3>

            <p>1. Konsument może zgłosić Sprzedawcy reklamację poprzez kontakt na E-MAIL: bmcserwer@gmail.com. Reklamacja zostaje rozpatrzona w terminie 14 dni od jej złożenia.</p>

            <p>2. Konsumentowi nie przysługuje prawo do odstąpienia od umowy, jeżeli usługa została w pełni wykonana przez usługodawcę.</p>

            </br>

            <h3>-Postanowienia końcowe-</h3>

            <p>1. Administrator przetwarza dane na podstawie Polityki prywatności i Polityki cookies.</p>

            <p>2. Serwer blackmc.com.pl nie jest powiązany z firmą Mojang AB.</p>

            <p>3. W sprawach nieregulowanych powyższym dokumentem mają zastosowanie powszechnie obowiązujące przepisy prawa polskiego.</p>

            </br>
            <h3>-Dane przedsiębiorcy-</h3>

            <p>Imię i nazwisko: Martin Ramiączek</p>

            <p>Miasto: Wałbrzych</p>

            <p>Kod pocztowy: 58-316</p>

            <p>Ulica: Jana Pawła II 2</p>

            <p>E-mail: bmcserwer@gmail.com</p>

            <p>Działalność gospodarcza: niezarejestrowana</p>
            </br>

            <p>Regulamin został opublikowany dnia: 21.03.2021 roku</p>
            <p>Ostatnia zmiana w regulaminie została wprowadzona dnia: 07.09.2023 roku</p>
        </div>
    </main>
        
    <script src="js/loader.js"></script>
    <script src="js/profileDropdown.js"></script>
    <script src="js/pfp.js"></script>

</body>
</html>