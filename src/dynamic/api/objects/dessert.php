<?php
class Dessert {
    // подключение к базе данных и таблице 'desserts' 
    private $conn;
    private $table_name = "desserts";

    // свойства объекта 
    public $id;
    public $name;
    public $price;

    // конструктор для соединения с базой данных 
    public function __construct($db){
        $this->conn = $db;
    }

    // Полученеи видов кофе
    function get(){

        // выбираем все записи 
        $query = "SELECT id, name, price
                FROM " . $this->table_name;

        // подготовка запроса 
        $stmt = $this->conn->prepare($query);

        // выполняем запрос 
        $stmt->execute();

        return $stmt;
    }

    function getById(){

        // выбираем все записи 
        $query = "SELECT id FROM " . $this->table_name . " WHERE id = " . $this->id;

        // подготовка запроса 
        $stmt = $this->conn->prepare($query);

        // выполняем запрос 
        $stmt->execute();

        return $stmt;
    }

    // Создание кофе
    function create(){

        // запрос для вставки (создания) записей 
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, price=:price";

        // подготовка запроса 
        $stmt = $this->conn->prepare($query);

        // очистка 
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));

        // привязка значений 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);

        // выполняем запрос 
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Обновление кофе 
    function update(){

        // запрос для обновления записи (товара) 
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name = :name,
                    price = :price
                WHERE
                    id = :id";

        // подготовка запроса 
        $stmt = $this->conn->prepare($query);

        // очистка 
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // привязываем значения 
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':id', $this->id);

        // выполняем запрос 
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Удаление города 
    function delete(){

        // запрос для удаления записи (товара) 
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // подготовка запроса 
        $stmt = $this->conn->prepare($query);

        // очистка 
        $this->id=htmlspecialchars(strip_tags($this->id));

        // привязываем id записи для удаления 
        $stmt->bindParam(1, $this->id);

        // выполняем запрос 
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}
$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
switch ($method) {
    case 'GET':
        define('access', TRUE);
        include("../dessert/get.php");
        break;
    case 'POST':
        define('access', TRUE);
        include("../dessert/create.php");  
        break;
    case 'PUT':
        define('access', TRUE);
        include("../dessert/update.php");  
        break;
    case 'DELETE':
        define('access', TRUE);
        include("../dessert/delete.php"); 
        break;
    default:
        handle_error($request);  
        break;
}
?>