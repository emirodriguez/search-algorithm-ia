<?php

use Search\InformedSearcher;
use Search\UninformedSearcher;

require('vendor/autoload.php');

echo "Shopping center\n";

$connections = [
    'A' => ['B' => 10, 'E' => 40, 'F' => 10],
    'B' => ['A' => 10, 'G' => 20, 'E' => 20, 'F' => 30],
    'C' => ['D' => 5],
    'D' => ['C' => 5, 'E' => 10, 'G' => 10],
    'E' => ['H' => 10, 'D' => 10, 'B' => 20, 'E' => 40],
    'F' => ['A' => 10, 'B' => 30, 'H' => 20, 'G' => 10],
    'G' => ['B' => 20, 'G' => 10, 'D' => 10],
    'H' => ['E' => 10, 'F' => 10],
];

$heuristic = [
    'A' => 5,
    'B' => 20,
    'C' => 0,
    'D' => 0,
    'E' => 0,
    'F' => 25,
    'G' => 20,
    'H' => 5,
];

$start = 'F';
$end = 'D';

$searcher = new InformedSearcher();

$result = $searcher->searchSolution($connections, $heuristic, $start, $end);

echo "Solución: \n";
echo implode(" --> ", $result['result']);
echo "\n";
echo "Costo: " . $result['cost'];
echo "\n";
echo "\n";

echo "Laberinto\n";

$connections = [
    '1' => ['2', '4'],
    '2' => ['1', '3'],
    '3' => ['2'],
    '4' => ['1', '5', '6'],
    '5' => ['4', '7', '6'],
    '6' => ['4', '5', '7', '8'],
    '7' => ['6', '5', '8'],
    '8' => ['6', '7'],
];

$resolver = new UninformedSearcher();

$start = '1';
$end = '8';

$result = $resolver->searchSolution($connections, $start, $end);

echo "Solucion por anchura: \n";
echo implode(" --> ", $result);
echo "\n";
