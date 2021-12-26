<?php
class CoffeeHouseGenerator {
// генерируем массив кофейн
    public static function generate($count){
    	$arr = array();
    	for ($i = 0; $i < $count; $i++) {
    		$coffeeHouse = require 'coffeehouse.php';
    		array_push($arr, $coffeeHouse);
		}
        return $arr;
    }
}
?>