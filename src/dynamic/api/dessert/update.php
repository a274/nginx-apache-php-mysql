<?php
if(!defined('access')) {
    header("HTTP/1.0 404 Not Found");
    die();
}
// необходимые HTTP-заголовки 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// подключаем файл для работы с БД и объектом dessert 
include_once '../config/database.php';
include_once '../objects/dessert.php';

// получаем соединение с базой данных 
$database = new Database();
$db = $database->getConnection();

// подготовка объекта 
$dessert = new Dessert($db);

// получаем id города для редактирования 
$data = json_decode(file_get_contents("php://input"));

// установим id свойства города для редактирования 
$dessert->id = $_GET["id"];

// если в бд есть город, то обновляем его
if($dessert->getById()->rowCount() != 0)
{
	// установим значения свойств города 
	$dessert->name = $data->name;
	$dessert->price = $data->price;

	// обновление города 
	if ($dessert->update()) {

	    // установим код ответа - 200 ok 
	    http_response_code(200);

	    // сообщим пользователю 
	    echo json_encode(array("message" => "Десерт был обновлён."), JSON_UNESCAPED_UNICODE);
	}

	// если не удается обновить город, сообщим пользователю 
	else {

	    // код ответа - 503 Сервис не доступен 
	    http_response_code(503);

	    // сообщение пользователю 
	    echo json_encode(array("message" => "Невозможно обновить Десерт."), JSON_UNESCAPED_UNICODE);
	}
}
else
{
	// код ответа - 404 город не найден 
    http_response_code(404);

    // сообщение пользователю 
    echo json_encode(array("message" => "Не удалось найти обновляемый Десерт."), JSON_UNESCAPED_UNICODE);
}
?>