<?php
if(!defined('access')) {
    header("HTTP/1.0 404 Not Found");
    die();
}
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// подключим файл для соединения с базой и объектом coffee
include_once '../config/database.php';
include_once '../objects/coffee.php';

// получаем соединение с БД
$database = new Database();
$db = $database->getConnection();

// подготовка объекта


$coffee = new Coffee($db);

// получаем id города
$data = json_decode(file_get_contents("php://input"));

// установим id города для удаления
$coffee->id = $_GET["id"];

// если в бд есть город, то удаляем его
if($coffee->getById()->rowCount() != 0)
{
	// удаление города
	if ($coffee->delete()) {

	    // код ответа - 200 ok
	    http_response_code(200);

	    // сообщение пользователю
	    echo json_encode(array("message" => "кофе был удалён."), JSON_UNESCAPED_UNICODE);
	}

	// если не удается удалить город
	else {

	    // код ответа - 503 Сервис не доступен
	    http_response_code(503);

	    // сообщим об этом пользователю
	    echo json_encode(array("message" => "Не удалось удалить кофе."));
	}
}
else
{
	// код ответа - 404 не найден город
	http_response_code(404);

    // сообщим об этом пользователю
    echo json_encode(array("message" => "Не удалось найти удаляемый кофе."));
}
?>