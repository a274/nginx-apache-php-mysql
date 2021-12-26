<?php
if (isset($_POST['name']) && empty($_POST['name'])) echo "<p style=\"color: red\" >Name input is empty.<p>";
if (isset($_POST['location']) && empty($_POST['location'])) echo "<p style=\"color: red\" >Location input is empty.<p>";
if (isset($_POST['number']) && empty($_POST['number'])) echo "<p style=\"color: red\" >Number input is empty.<p>";

if (isset($_POST['name']) &&
    (isset($_POST['location']) && (!empty($_POST['location']))) &&
    (isset($_POST['number']) && (!empty($_POST['number'])))) {

    $name = $_POST['name'];
    $location = $_POST['location'];
    $number = $_POST['number'];

    setcookie('name', $name);
    setcookie('location', $location);
    setcookie('number', $number);

} elseif (isset($_COOKIE['name']) &&
    (isset($_COOKIE['location']) && (!empty($_COOKIE['location']))) &&
    (isset($_COOKIE['number']) && (!empty($_COOKIE['number'])))) {

    $name = $_COOKIE['name'];
    $location = $_COOKIE['location'];
    $number = $_COOKIE['number'];

} else {

    $name = 'Гость';
    $location = 'Местоположение';
    $number = 'Номер телефона';
}
?>
<html lang="en">
    <head>
        <title>Информация о пользователе</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="../css/style.css" type="text/css"/>
    </head>
    <body>
        <a href="/index.html">На главную</a>
        <p>Привет, <?= $name; ?></p>
        <?php echo "$location<br>$number<br><hr>"; ?>

        <form method="post">
            Введите имя: <input type="text" name="name" /><br>
            Введите город: <input type="text" name="location" /><br>
            Введите телефон: <input type="text" name="number" /><br>
            <input type="reset" value="Clear the form">
            <input type="submit" value="Submit" name="submit">
        </form>
    </body>
</html>