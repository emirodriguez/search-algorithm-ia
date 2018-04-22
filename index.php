<?php
require('vendor/autoload.php');

use Search\InformedSearcher;
use Search\UninformedSearcher;

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

$resolver = new UninformedSearcher();

$start = 'A';
$end = 'B';

$result = $resolver->searchSolution($connections, $start, $end);

echo "BUSQUEDA NO INFORMADA: \n";
echo "Anchura: \n";
echo implode(" --> ", $result);
echo "\n";

$result = $resolver->searchSolution($connections, $start, $end, true);

echo "Profundidad: \n";
echo implode(" --> ", $result);
echo "\n";

//CIUDADES RUMANAS
//$connections = [
//    'A' => [['Z' => 75], ['S' => 140], ['T' => 118]],
//    'Z' => [['A' => 75], ['O' => 71]],
//    'S' => [['A' => 140], ['O' => 151], ['F' => 99], ['R' => 80]],
//    'T' => [['A' => 118], ['L' => 111]],
//    'O' => [['Z' => 71], ['S' => 151]],
//    'F' => [['S' => 99], ['B' => 211]],
//    'R' => [['S' => 80], ['P' => 97], ['C' => 146]],
//    'B' => [['F' => 211], ['P' => 101], ['G' => 90], ['U' => 85]],
//    'P' => [['R' => 97], ['C' => 138], ['B' => 101]],
//    'L' => [['T' => 111], ['M' => 70]],
//    'M' => [['L' => 70], ['D' => 75]],
//    'D' => [['M' => 75], ['C' => 120]],
//    'C' => [['D' => 120], ['R' => 146], ['P' => 138]],
//    'G' => [['B' => 90]],
//    'U' => [['B' => 85], ['V' => 142], ['H' => 98]],
//    'H' => [['U' => 98], ['E' => 86]],
//    'E' => [['H' => 86]],
//    'V' => [['U' => 142], ['I' => 92]],
//    'I' => [['V' => 92], ['N' => 87]],
//    'N' => [['I' => 87]]
//];
//
//$heuristic = [
//    'A' => 366,
//    'B' => 0,
//    'C' => 160,
//    'D' => 242,
//    'E' => 161,
//    'F' => 178,
//    'G' => 77,
//    'H' => 151,
//    'I' => 226,
//    'L' => 244,
//    'M' => 241,
//    'N' => 234,
//    'O' => 380,
//    'P' => 98,
//    'R' => 193,
//    'S' => 253,
//    'T' => 329,
//    'U' => 80,
//    'V' => 199,
//    'Z' => 374
//];

$connections = [
    '1' => [['2' => 200]],
    '2' => [['1' => 200], ['3' => 150], ['4' => 350], ['5' => 450]],
    '3' => [['2' => 150], ['5' => 400], ['6' => 225]],
    '4' => [['2' => 350], ['5' => 300]],
    '5' => [['2' => 450], ['3' => 400], ['4' => 300], ['7' => 250]],
    '6' => [['3' => 225], ['7' => 450]],
    '7' => [['5' => 250], ['6' => 450], ['8' => 125]],
    '8' => [['7' => 125]],
];

$heuristic = [
    '1' => 800,
    '2' => 650,
    '3' => 500,
    '4' => 650,
    '5' => 325,
    '6' => 375,
    '7' => 125,
    '8' => 0
];

$start = '1';
$end = '8';

$resolver = new InformedSearcher();

$result = $resolver->searchSolution($connections, $heuristic, $start, $end);

echo "BUSQUEDA INFORMADA: \n";
echo implode(" --> ", $result['result']);
echo "\n";
echo "Costo: " . $result['cost'];
echo "\n";
