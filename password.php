<?php
session_start();
if(isset($_SESSION['logged'])) {
    header('Location: index.php');
}
$token = $_GET['token'];
if(!isset($token))
{
    header('Location:index.php');
    exit();
}
$mysql_connection = new mysqli('#', '#', '#', '#');
if ($mysql_connection -> connect_errno) {
    exit();
}
$query = $mysql_connection->query("SELECT * FROM token WHERE token='$token'");
if($query->num_rows == 0)
{
    header('Location: index.php');
    exit();
}
if((isset($_POST['pass'])) && (isset($_POST['passrepeat'])))
{
    $password = $_POST['pass']; 
    if(!($_POST['pass'] == $_POST['passrepeat']))
    {
        $_SESSION['passnotmatch'] = true;
        header("Location: password.php?token=$token");
        exit();
    }
    if((strlen($_POST['pass']) >= 5) && (strlen($_POST['pass']) <= 30))
    {
        while($row = $query->fetch_assoc())
        {
            $id = $row['id_user'];
            $query2 = $mysql_connection->query("SELECT * FROM authme WHERE id=$id");
            while($row2 = $query2->fetch_assoc()) {
            $salt = substr($row2['password'], 5, 16);
            }
            $newpassword = hash('sha256', hash('sha256', $password).$salt);
            $query2 = $mysql_connection->query('UPDATE authme SET password="$SHA$'.$salt.'$'.$newpassword.'" WHERE id='.$row['id_user']);
            $query3 = $mysql_connection->query("DELETE FROM token WHERE token='$token'");
            $_SESSION['changedpass'] = true;
        }
    } else {
        header("Location: password.php?token=$token");
        $_SESSION['passlength'] = true;
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FantasyMC</title>
</head>
<body>
    <form method="POST">
        <?php
        if(!isset($_SESSION['changedpass'])) {
        ?>
            <input type="password" placeholder="hasło" name="pass">
            <input type="password" placeholder="powtórz hasło" name="passrepeat">
            <input type="submit" value="Zatwierdź">
        <?php
        }
        else {
        unset($_SESSION['changedpass']);
        $_SESSION['newpass'] = true;
        header('Location: authme.php');
        }
        if(isset($_SESSION['passnotmatch']))
        {
            echo "Hasła nie są takie same!";
            unset($_SESSION['passnotmatch']);
        }
        if(isset($_SESSION['passlength']))
        {
            echo "Hasło musi mieć minimalnie 5 i maksymalnie 30 znaków!";
            unset($_SESSION['passlength']);
        }
        ?>
    </form>
</body>
</html>