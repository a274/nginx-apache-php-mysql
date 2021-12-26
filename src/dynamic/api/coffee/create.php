<?php
if(!defined('access')) {
    header("HTTP/1.0 404 Not Found");
    die();
}
// для соединение с базой данных 
include_once '../config/database.php';
// создание объекта города 
include_once '../objects/coffee.php';

$database = new Database();
$db = $database->getConnection();

$coffee = new Coffee($db);
 
// получаем отправленные данные 
$data = json_decode(file_get_contents("php://input"));
 
// убеждаемся, что данные не пусты 
if (
    !empty($data->name) &&
    !empty($data->price)
    ) {

    // устанавливаем значения свойств города 
    $coffee->name = $data->name;
    $coffee->price = $data->price;

    // создание города 
    if($coffee->create()){

        // установим код ответа - 201 создано 
        http_response_code(201);

        // сообщим пользователю 
        echo json_encode(array("message" => "Кофе был создан."), JSON_UNESCAPED_UNICODE);
    }

    // если не удается создать город, сообщим пользователю 
    else {

        // установим код ответа - 503 сервис недоступен 
        http_response_code(503);

        // сообщим пользователю 
        echo json_encode(array("message" => "Невозможно создать кофе."), JSON_UNESCAPED_UNICODE);
    }
}

// сообщим пользователю что данные неполные 
else {

    // установим код ответа - 400 неверный запрос 
    http_response_code(400);

    // сообщим пользователю 
    echo json_encode(array("message" => "Невозможно создать кофе. Данные неполные."), JSON_UNESCAPED_UNICODE);
}
?>