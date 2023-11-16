<?php
header('Content-Type: application/json; charset=utf-8');
$mysql_connection = new mysqli('#', '#', '#', '#');
if ($mysql_connection -> connect_errno) {
    exit();
}
if (!$mysql_connection->set_charset("utf8")) {
    echo "Błąd ustawienia zestawu znaków: %s\n", $mysql_connection->error;
    exit();
}
$nick = $_GET['nick'];
if(!isset($nick)) {
    header('Location: index.php');
    exit();
}
$query = "SELECT * FROM stats WHERE username LIKE '$nick'";
$result = $mysql_connection->query($query);
$array = $result->fetch_all();
header('Content-type: application/json');
echo json_encode($array);
