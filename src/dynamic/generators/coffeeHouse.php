<?php
require_once '/vendor/autoload.php';
// Автозагрузчик ищет запрашиваемый класс в карте классов,
// которая представляет собой ассоциативный массив, находящийся в отдельном файле vendor/classes.php.
$faker = Faker\Factory::create('ru_RU'); // Если нужен русская локализация, передать её параметром в метод create

return array( //создаем и возвращаем массив - данные о кофейне
    'id' => $faker->uuid(),
    'address' => $faker->address(),
    'profit' => $faker->numberBetween($min = 50000, $max = 100000),
    'coffeeOfTheDay' => $faker->randomElement($array = array ('Американо','Капучино','Латте', 'По-Венски', 'Мокачино', 'Мокко')),
    'dessertOfTheDay' => $faker->randomElement($array = array ('Чизкейк','Наполеон','Эклер', 'Пончик', 'Прага', 'Птичье молоко', 'Крем-брюле')),
);
?>