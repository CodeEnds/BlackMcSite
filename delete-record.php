<?php
if($_SERVER['REMOTE_ADDR'] != '') {
    header('Location:index.php');
    exit();
}
$mysql_connection = new mysqli('#', '#', '#', '#');
if ($mysql_connection -> connect_errno) {
    exit();
}
$result = $mysql_connection->query('SELECT * FROM token');
while($row = $result->fetch_assoc())
{
    $time = $row['time'] - 1;
    $id = $row['id'];
    $mysql_connection->query("UPDATE token SET time =".$time." WHERE id=".$id);
}
$mysql_connection->query("DELETE FROM token WHERE time=0");
