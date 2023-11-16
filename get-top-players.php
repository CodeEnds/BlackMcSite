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
$top = $_GET['type'];
if(!isset($top)) {
    header('Location: index.php');
    exit();
}

if($_GET['type'] == "level") {
    $query = "SELECT username, level FROM stats WHERE NOT ranga='admin' ORDER BY level DESC, exp DESC LIMIT 10";
} else {
    $query = "SELECT username, $top FROM stats WHERE NOT ranga='admin' ORDER BY $top DESC LIMIT 10";
}
// $query = "SELECT username, $top FROM stats ORDER BY $top DESC LIMIT 10";
$result = $mysql_connection->query($query);
$array = $result->fetch_all();
header('Content-type: application/json');
echo json_encode($array);