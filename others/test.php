<?php

echo "Input row and column: ";
$row_column = trim(fgets(STDIN));

if ($row_column < 2) {
    echo "Sorry. Row and column cannot be < 2";
    die;
}

$matrix = array();

for ($i = 0; $i < $row_column; $i++) {
    for ($j = 0; $j < $row_column; $j++) {
        echo "Input row [$i] and column [$j]: ";
        $matrix[$i][$j] = trim(fgets(STDIN));
    }
}

echo "N = $row_column\n";

for ($i = 0; $i < $row_column; $i++) {
    for ($j = 0; $j < $row_column; $j++) {
        echo $matrix[$i][$j] . " ";
    }
    echo "\n";
}

// Diagonal
$d1 = 0;
$d2 = 0;
$row_column = range(0, $row_column - 1);
$row_column_reverse = array_reverse($row_column);

foreach ($row_column as $item) {
    $d1 += $matrix[$row_column[$item]][$row_column[$item]];
    $d2 += $matrix[$row_column[$item]][$row_column_reverse[$item]];
}

$diff = abs($d2 - $d1);

echo "Diagonal difference result  = $diff";
