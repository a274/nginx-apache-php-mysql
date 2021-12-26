<?php
if(!defined('access')) {
    header("HTTP/1.0 404 Not Found");
    die();
}
// необходимые HTTP-заголовки 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение к базе данных будет здесь

// подключение базы данных и файл, содержащий объекты 
include_once '../config/database.php';
include_once '../objects/dessert.php';

// получаем соединение с базой данных 
$database = new Database();
$db = $database->getConnection();

// инициализируем объект 
$dessert = new Dessert($db);
 
// чтение городов будет здесь

// запрашиваем Города 
$stmt = $dessert->get();
$num = $stmt->rowCount();

// проверка, найдено ли больше 0 записей 
if ($num>0) {

    // массив городов 
    $desserts_arr=array();
    $desserts_arr["records"]=array();

    // получаем содержимое нашей таблицы 
    // fetch() быстрее, чем fetchAll() 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        // извлекаем строку 
        extract($row);

        $dessert_item=array(
            "id" => $id,
            "name" => $name,
            "price" => html_entity_decode($price),
        );

        array_push($desserts_arr["records"], $dessert_item);
    }

    // устанавливаем код ответа - 200 OK 
    http_response_code(200);

    // выводим данные о товаре в формате JSON 
    echo json_encode($desserts_arr);
}

else {

    // установим код ответа - 404 Не найдено 
    http_response_code(404);

    // сообщаем пользователю, что Города не найдены 
    echo json_encode(array("message" => "Десерты не найдены."), JSON_UNESCAPED_UNICODE);
}