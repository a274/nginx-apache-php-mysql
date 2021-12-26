<?php
session_start();
if (isset($_COOKIE['name']) &&
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
        <title>Цены на товары</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="../css/style.css" type="text/css"/>
    </head>
    <body>
        <a href="/index.html">На главную</a>
        <p>Привет, <?= $name; ?></p>
        <?php echo "$location<br>$number<br><hr>"; ?>
        <h1>Таблица цен</h1>

        <table>
            <tr><th>Id</th><th>Name</th><th>Price</th></tr>
            <?php
            $mysqli = new mysqli("db", "root", "root", "appDb");
            $result = $mysqli->query("SELECT * FROM prices");
            foreach ($result as $row) {
                echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['price']}</td></tr>";
            }
            ?>
        </table>

    </body>
</html>