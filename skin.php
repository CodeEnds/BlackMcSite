<?php
// if($_SERVER['REMOTE_ADDR'] != '') {
//     header('Location:index.php');
//     exit();
// }
$nick = strtolower($_GET['nick']);
if(!isset($nick)) {
    header('Location: index.php');
}
$mysql_connection = new mysqli('#', '#', '#', '#');
if ($mysql_connection -> connect_errno) {
     exit();
}
$result = $mysql_connection->query('SELECT * FROM sr_legacy_skins WHERE name="'.$nick.'"');
if($result->num_rows == 0)
{
    header('Location:img/default-skin.png');
}
while($row = $result->fetch_assoc()) {
    $img_url = json_decode(base64_decode($row['value']))->textures->SKIN->url;
    $img_url = str_replace("http://", "https://", $img_url);
    header('Location:'.$img_url);
}