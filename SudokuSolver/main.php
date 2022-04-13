#!/usr/local/opt/php55/bin/php
<?php
/**
 * Created by IntelliJ IDEA.
 * User: jeffg
 * Date: 5/6/15
 * Time: 9:47 PM
 */

// config

// Simple file that contains starting puzzle
// in the form of 0's for blanks and one space between
// example:
// 0 0 0 5 0 7 0 1 0 0
// 0 0 0 0 0 0 0 0 0 0
// etc
$input_file = "sudoku.txt";


// Make some room on the screen
echo "\n\n\n";

echo "Starting Sudoku Solver!\n";

$puzzle = array();

echo "Reading in the input file {$input_file}\n";
$infile = fopen("sudoku.txt", "r");
while (!feof($infile)) {
  $line = fgets($infile);
  if ($line) {
    $puzzle[] = explode(" ", $line);
  }
}
fclose($infile);
print_r($puzzle);

$innerloop = 100000;
$outerloop = 10;

echo "Test w/o output\n";
$start2 = microtime(true) * 1000;
echo "\n";
for ($i = 0; $i < $outerloop; $i++) {
  for ($j = 0; $j < $innerloop; $j++) {
    $total = number_format($i * $innerloop + $j);
    // echo "Count: {$total}\r";
  }
}
$end2 = microtime(true) * 1000;

echo "Test with output\n";
$start1 = microtime(true) * 1000;
echo "\n";
for ($i = 0; $i < $outerloop; $i++) {
  for ($j = 0; $j < $innerloop; $j++) {
    $total = number_format($i * $innerloop + $j);
    echo "Count: {$total}\r";
  }
}
$end1 = microtime(true) * 1000;

$time1 = number_format($end1 - $start1);
$time2 = number_format($end2 - $start2);

echo "Time w/  output = {$time1} (millisec)\n";
echo "Time w/o output = {$time2} (millisec)\n";


echo "Puzzle solution complete!\n\n";
sleep(5);


