<?php
session_start();
if(isset($_SESSION['consolelogged'])) {
    header('Location: console');
    exit();
}
if(isset($_POST['one']) && isset($_POST['one']) && isset($_POST['one']) && isset($_POST['one'])) {
    if($_POST['one'] == 1 && $_POST['two'] == 9 && $_POST['three'] == 1 && $_POST['four'] == 4) {
        $_SESSION['consolelogged'] = true;
        header('Location: console');
        exit();
    } else {
        $_SESSION['pinwrong'] = true;
        header('Location:console-pin.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/logowanie.min.css">
</head>
<body>
    <form method="POST">
        <p class="title">Wpisz pin</p>
        <div class="input-container">
            <input name="one" type="number" min="0" max="9">
            <input name="two" type="number" min="0" max="9">
            <input name="three" type="number" min="0" max="9">
            <input name="four" type="number" min="0" max="9">
        </div>
        <button type="submit">
            <div class="button-white-fill"></div>
            <div class="button-fill"></div>
            <div class="submit-text">WYŚLIJ</div>
        </button>
    </form>
    <script src="js/pincode.js"></script>
    <?php
    if(isset($_SESSION['pinwrong']))
    {
        echo "<div class='errbox'>".
            "<img src='img/error.png' alt='error'>".
            "Niepoprawny PIN!".
            "</div>";
        unset($_SESSION['pinwrong']);
        exit();
    }
    ?>
</body>
</html>