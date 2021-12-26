<?php

if (!defined('access')) {
    header("HTTP/1.0 404 Not Found");
    die();
}
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение к базе данных будет здесь
// подключение базы данных и файл, содержащий объекты
include_once '../config/database.php';
include_once '../objects/coffee.php';

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// инициализируем объект
$coffee = new Coffee($db);
$stmt = $coffee->get();
// чтение городов будет здесь
if (isset($_GET["id"])) {
    $coffee->id = $_GET["id"];
// если в coffee есть город, то удаляем его
    if ($coffee->getById()->rowCount() != 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // извлекаем строку
            extract($row);
            if ($id == $coffee->id) {
                $coffee_item = array(
                    "id" => $id,
                    "name" => $name,
                    "price" => html_entity_decode($price),
                );
                echo json_encode($coffee_item);
                break;
            }
        }
    }

    // если не удается удалить город
    else {

        // код ответа - 503 Сервис не доступен
        http_response_code(503);

        // сообщим об этом пользователю
        echo json_encode(array("message" => "Не удалось удалить кофе."));
    }
} else {


// запрашиваем Города
    $stmt = $coffee->get();
    $num = $stmt->rowCount();

// проверка, найдено ли больше 0 записей
    if ($num > 0) {

        // массив городов
        $coffees_arr = array();
        $coffees_arr["records"] = array();

        // получаем содержимое нашей таблицы
        // fetch() быстрее, чем fetchAll()
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            // извлекаем строку
            extract($row);

            $coffee_item = array(
                "id" => $id,
                "name" => $name,
                "price" => html_entity_decode($price),
            );

            array_push($coffees_arr["records"], $coffee_item);
        }

        // устанавливаем код ответа - 200 OK
        http_response_code(200);

        // выводим данные о товаре в формате JSON
        echo json_encode($coffees_arr);
    } else {

        // установим код ответа - 404 Не найдено
        http_response_code(404);

        // сообщаем пользователю, что Города не найдены
        echo json_encode(array("message" => "Кофе не найдены."), JSON_UNESCAPED_UNICODE);
    }
}
