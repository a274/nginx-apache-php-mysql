<?php
include_once 'generators/coffeeHouseGenerator.php';
include_once 'generators/graphGenerator.php';
$count = 50;
$coffeeHouses = CoffeeHouseGenerator::generate($count);

# Data for Line plot
$dataxLine = array('[50000р.;60000р.)', '[60000р.;70000р.)', '[70000р.;80000р.)', '[80000р.;90000р.)', '[90000р.;100000р.]');
$datayLine = array(0, 0, 0, 0, 0);
for ($i = 0; $i < $count; $i++) {
	if ($coffeeHouses[$i]['profit'] >= 50000 && $coffeeHouses[$i]['profit'] < 60000) {
		$datayLine[0]++;
	}
	else if ($coffeeHouses[$i]['profit'] >= 60000 && $coffeeHouses[$i]['profit'] < 70000) {
		$datayLine[1]++;
	}
	else if ($coffeeHouses[$i]['profit'] >= 70000 && $coffeeHouses[$i]['profit'] < 80000) {
		$datayLine[2]++;
	}
	else if ($coffeeHouses[$i]['profit'] >= 80000 && $coffeeHouses[$i]['profit'] < 90000) {
		$datayLine[3]++;
	}
	else if ($coffeeHouses[$i]['profit'] >= 90000 && $coffeeHouses[$i]['profit'] <= 100000) {
		$datayLine[4]++;
	}
}

# Data for Bar plot
$dataxBar = array('Американо','Капучино','Латте', 'По-Венски', 'Мокачино', 'Мокко');
$datayBar = array(0, 0, 0, 0, 0, 0);
for ($i = 0; $i < $count; $i++) {
	for ($j = 0; $j < 6; $j++) {
		if ($coffeeHouses[$i]['coffeeOfTheDay'] == $dataxBar[$j]) {
			$datayBar[$j]++;
		}
	}
}

# Data for Pie plot
$legendPie = array('Чизкейк','Наполеон','Эклер', 'Пончик', 'Прага', 'Птичье молоко', 'Крем-брюле');
$dataPie = array(0, 0, 0, 0, 0, 0, 0);
for ($i = 0; $i < $count; $i++) {
	for ($j = 0; $j < 7; $j++) {
		if ($coffeeHouses[$i]['dessertOfTheDay'] == $legendPie[$j]) {
			$dataPie[$j]++;
		}
	}
}

$lineGraph = GraphGenerator::generateLineGraph($dataxLine, $datayLine);
$barGraph = GraphGenerator::generateBarGraph($dataxBar, $datayBar);
$pieGraph = GraphGenerator::generatePieGraph($legendPie, $dataPie);
$generatedGraphs = array($lineGraph, $barGraph, $pieGraph);

for ($i = 0; $i < count($generatedGraphs); $i++) {
	// Загрузка штампа и фото, для которого применяется водяной знак (называется штамп или печать)
	$im = $generatedGraphs[$i]->Stroke(_IMG_HANDLER);

	// Сначала создаём наше изображение штампа вручную с помощью GD
	$stamp = imagecreatetruecolor(100, 70);
	imagefilledrectangle($stamp, 0, 0, 99, 69, 0x808080);
	imagefilledrectangle($stamp, 9, 9, 90, 60, 0xFFFFFF);
	imagestring($stamp, 3, 10, 20, 'Khlopovskaya', 0x808080);
	imagestring($stamp, 3, 10, 40, '(c) 2021', 0x808080);

	// Установка полей для штампа и получение высоты/ширины штампа
	$marge_right = 10;
	$marge_bottom = 10;
	$sx = imagesx($stamp);
	$sy = imagesy($stamp);

	// Слияние штампа с фотографией. Прозрачность 50%
	imagecopymerge($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 50);

	//read the imagedata into a variable
	ob_start();
	imagepng($im);
	// Capture the output and clear the output buffer
	$imagedata = ob_get_clean();
	imagedestroy($im);

	print '<img style="display:block; margin-left: auto; margin-right: auto; margin-bottom:50px;" src="data:image/png;base64,'.base64_encode($imagedata).'"/>';
}