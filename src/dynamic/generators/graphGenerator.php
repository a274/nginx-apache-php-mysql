<?php
require_once '/vendor/autoload.php';
use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;
class GraphGenerator {
    public static function generateLineGraph($datax, $datay){
    	// The code to setup a very basic graph
		$graph = new Graph\Graph(800, 400);
		//to get a date time scale for the X-axis
		$graph->SetScale('datint');
		$graph->SetMargin(60, 60, 40, 30);
		$graph->SetMarginColor('white');

		$graph->title->Set('Диаграмма интервалов прибили к количеству кофеен');
		$graph->xaxis->title->Set('Интервалы прибыли');
		$graph->yaxis->title->Set('Количество кофеен');
		$graph->title->SetFont(FF_VERDANA, FS_BOLD);
		$graph->yaxis->title->SetFont(FF_VERDANA, FS_BOLD);
		$graph->xaxis->title->SetFont(FF_VERDANA, FS_BOLD);
		$graph->xgrid->Show();

		// Create the plot line
		$p1 = new Plot\LinePlot($datay);
		$graph->Add($p1);
		$graph->xaxis->SetTickLabels($datax);
		return $graph;
    }
    public static function generateBarGraph($datax, $datay){
		// Create the graph. These two calls are always required
		$graph = new Graph\Graph(500, 400);
		//Линейный масштаб
		$graph->SetScale('textlin');

		// Adjust the margin a bit to make more room for titles
		$graph->img->SetMargin(40, 30, 20, 40);

		// Create a bar pot
		$bplot = new Plot\BarPlot($datay);
		$bplot->SetWidth(0.6);
		$bplot->SetFillGradient('navy', 'lightsteelblue', GRAD_MIDVER);
		$bplot->SetColor('navy');
		$graph->xaxis->SetTickLabels($datax);
		$graph->Add($bplot);

		// Setup the titles
		$graph->title->Set('Гистограмма популярности кофе в кофейнях');
		$graph->xaxis->title->Set('Виды кофе');
		$graph->yaxis->title->Set('Количество кофеен');

		$graph->title->SetFont(FF_VERDANA, FS_BOLD);
		$graph->yaxis->title->SetFont(FF_VERDANA, FS_BOLD);
		$graph->xaxis->title->SetFont(FF_VERDANA, FS_BOLD);
		return $graph;
    }
    public static function generatePieGraph($legend, $data){
		// Create the Pie Graph.
		$graph    = new Graph\PieGraph(500, 400);
		$graph->title->Set('Круговая диаграмма популярности десертов в кофейнях');
		$graph->title->SetFont(FF_VERDANA, FS_BOLD);
		$graph->SetBox(true);
		$graph->legend->SetPos(0.5,0.98,'center','bottom');

		$p1   = new Plot\PiePlot($data);
		$p1->ShowBorder();
		$p1->SetColor('black');
		$p1->SetSliceColors(['#FF0000', '#FF7F00', '#FFFF00', '#00FF00', '#0000FF', '#4B0082', '#F81894']);
		$p1->SetLegends($legend);

		$graph->Add($p1);
		return $graph;
    }
}
?>