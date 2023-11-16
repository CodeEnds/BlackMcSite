<?php
$mysql_connection = new mysqli('#', '#', '#', '#');
if ($mysql_connection -> connect_errno) {
    exit();
}
if (!$mysql_connection->set_charset("utf8")) {
    echo "Błąd ustawienia zestawu znaków: %s\n", $mysql_connection->error;
    exit();
}
if(isset($_POST['nick'])) {
    $email = $_POST['email'];
    $nick = $_POST['nick'];
    $id = $_POST['order'];
    $option = $_POST['timespan'];
    $orderID = 1;
    $price = "price1";
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        if(isset($option)) {
            if($option == "1 miesiąc") {
                $price = "price1";
            } else if($option == "3 miesiące") {
                $price = "price2";
            } else if($option ==  "Na zawsze") {
                $price = "price3";
            }
        }
        $query = $mysql_connection->prepare("SELECT * FROM services WHERE id=? LIMIT 1");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();
        if($result->num_rows == 0) {
            header('Location:index.php');
            exit();
        }
        $time = new DateTime();
        $time->setTimezone(new DateTimeZone('Europe/Warsaw'));
        $timestamp = $time->format("Y/m/d G:i:s");
        while($row = $result->fetch_assoc()) {
            $serviceName = $row['title'];
            $priceFinal = $row[$price];
            if(!$mysql_connection->query("INSERT INTO hotpay_przelewy VALUES(NULL, '$email', '$nick', '$serviceName', '$option', '$timestamp', 'Rozpoczeto', '$priceFinal')")) {
                header('Location:buy.php?order='.$id);
                $_SESSION['databaserror'] = true;
                exit();
            } else {
                $query2 = "SELECT id FROM hotpay_przelewy ORDER BY id DESC LIMIT 1";
                $result2 = $mysql_connection->query($query2);
                while($row2 = $result2->fetch_assoc()) {
                    $orderID = $row2['id'] + 1;
                }
            }
        }
    } else {
        header('Location:buy.php?order='.$id);
        $_SESSION['mailerror'] = true;
        exit();
    }
} else {
    header('Location:index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="icon" href="img/favicon.ico">
        <title>BlackMC - Walidacja</title>
        <link rel="stylesheet" href="css/logowanie.min.css">
</head>
<body>
<?php
    $FORMULARZ = [
        "SEKRET" => "#,",
        "KWOTA" => $priceFinal,
        "NAZWA_USLUGI" => "$serviceName",
        "ADRES_WWW" => "http://blackmc.com.pl/success.php",
        "ID_ZAMOWIENIA" => $orderID,
        "EMAIL" => $email,
        "NICK" => $nick,
    ];

    echo '<form id="order" action="https://platnosc.hotpay.pl/" method="post" name="payment">';
    foreach ($FORMULARZ as $klucz=>$value){
        echo '<input name="'.$klucz.'" value="'.$value.'" type="hidden">';
    }
    // HASH funkcji skrótu sha256, składającej się z hash("sha256","HASLOZUSTAWIEN".";" . $FORMULARZ["KWOTA"] . ";" . $FORMULARZ["NAZWA_USLUGI"] . ";" . $FORMULARZ["ADRES_WWW"] . ";" . $FORMULARZ["ID_ZAMOWIENIA"] . ";" . $FORMULARZ["SEKRET"])
    echo '<input name="HASH" required value="'.hash("sha256", "Blackmc123".";" . $FORMULARZ["KWOTA"] . ";" . $FORMULARZ["NAZWA_USLUGI"] . ";" . $FORMULARZ["ADRES_WWW"] . ";" . $FORMULARZ["ID_ZAMOWIENIA"] . ";" . $FORMULARZ["SEKRET"]).'" type="hidden">';
    echo '</form>';     
?>
<script>
    window.onload = function() {
        document.forms['payment'].submit();
    }
</script>
</body>
</html>
