<?php
require('vendor/autoload.php');

use Search\Resolver;

$connections = [
    'A' => ['D', 'F', 'G'],
    'D' => ['A', 'H', 'J'],
    'F' => ['A', 'C'],
    'G' => ['A'],
    'H' => ['D', 'B'],
    'J' => ['D', 'K'],
    'C' => ['F'],
    'E' => ['F', 'Z', 'W'],
    'B' => ['H'],
    'K' => ['J', 'L'],
    'Z' => ['E'],
    'W' => ['E'],
    'L' => ['K'],
];

$resolver = new Resolver();

$start = 'A';
$end = 'B';

$result =  $resolver->searchSolution($connections, $start, $end);

echo "Por anchura: \n";
echo implode(" --> ", $result);
echo "\n";

$result =  $resolver->searchSolution($connections, $start, $end, true);

echo "Por amplitud: \n";
echo implode(" --> ", $result);
echo "\n";