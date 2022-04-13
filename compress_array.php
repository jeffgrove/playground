<?php
/**
 * Created by IntelliJ IDEA.
 * User: jeffg
 * Date: 4/23/15
 * Time: 8:32 AM
 */

echo "\n\n*******\nStarting CompressArray Driver...\n";

$test = new Test();
$test->init();


// Run the tests
$test->runTests("Jeff", "compressArray_Jeff");
$test->runTests("Tim", "compressArray_Tim");


echo "\nCompressArray Driver Complete!\n******\n";
// We're done!!


class Test
{
  public $size1 = 12500;
  public $size2 = 25000;
  public $size3 = 50000;
  public $size4 = 100000;
  public $size5 = 200000;

  // These are the reference arrays that will not change
  public $array1 = array();
  public $array2 = array();
  public $array3 = array();
  public $array4 = array();
  public $array5 = array();


  function runTests($owner, $function) {

    // Start the testing!!
    $this->runTest($owner, $function, "{$this->size1} Elements", $this->array1);
    $this->runTest($owner, $function, "{$this->size2} Elements", $this->array2);
    $this->runTest($owner, $function, "{$this->size3} Elements", $this->array3);
    $this->runTest($owner, $function, "{$this->size4} Elements", $this->array4);
    $this->runTest($owner, $function, "{$this->size5} Elements", $this->array5);
  }

  function runTest($owner, $testFunction, $testName, &$array) {
    // Copy the array values
    $testArray = $array;

    echo "Testing {$owner}'s func: {$testFunction}, {$testName}...";

    $start = microtime(false);
    $testArrayCount = $testFunction($testArray);
    $end = microtime(false);
    $time = ($end - $start) * 1000;
    $success = $this->verifyResult($array, $testArray, $testArrayCount) ? 'true' : 'false';
    echo "execution time(millisec) = {$time}, test success = {$success}\n";
  }

  function verifyResult($startArray, $finalArray, $finalArrayCount) {

    // Remove dups from $startArray and get the count
    $deDupCount = $this->compressArray($startArray);

    if ($deDupCount != $finalArrayCount) {
      return false;
    }

    for ($i = 0; $i < $deDupCount; $i++) {
      if ($startArray[$i] != $finalArray[$i]) {
        return false;
      }
    }

    return true;
  }

  function compressArray(&$array) {

    $copyDestIndex = 0;

    // $size = $array->getSize();
    $size = count($array);
    for ($copySrcIndex = 1; $copySrcIndex < $size; $copySrcIndex++) {
      if ($array[$copyDestIndex] != $array[$copySrcIndex])
      {
        $copyDestIndex++;
        $array[$copyDestIndex] = $array[$copySrcIndex];
      }
    }

    return $copyDestIndex + 1;
  }



  function init() {
    // Initialize the contents of the Ref arrays
    $this->initVal($this->array1, $this->size1);
    $this->initVal($this->array2, $this->size2);
    $this->initVal($this->array3, $this->size3);
    $this->initVal($this->array4, $this->size4);
    $this->initVal($this->array5, $this->size5);

    // Print out a sample just to prove the input data is valid
    // $this->printArray($this->arrayRef10, "- Printing example array, arrayRef10");
    // $this->printArray($this->arrayRef100, "- Printing example array, arrayRef100\n");
  }

  static function initVal(&$splArray, $size)
  {
    $nextVal = 0;

    for ($i = 0; $i < $size; $i++) {
      $dups = rand(1, 4);
      for ($j = 0; $j < $dups; $j++) {
        if ($i + $j < $size) {
          $splArray[$i + $j] = $nextVal;
        }
      }
      $nextVal += rand(1, 2);

      $i += $j - 1;
    }
  }

  function printArray($array, $label = null) {
    echo "/n/nPrinting Array {$label}/n:";

    // print_r($array);
    $arrayCount = count($array);
    for ($i = 0; $i < $arrayCount; $i++) {
      echo $array[$i] . ', ';
    }

    echo "/nPrinting Complete\n";
  }



}

function compressArray_Jeff(&$array) {

  $copyDestIndex = 0;

  // $size = $array->getSize();
  $size = count($array);
  for ($copySrcIndex = 1; $copySrcIndex < $size; $copySrcIndex++) {
    if ($array[$copyDestIndex] != $array[$copySrcIndex])
    {
      $copyDestIndex++;
      $array[$copyDestIndex] = $array[$copySrcIndex];
    }
  }

  return $copyDestIndex + 1;
}

function compressArray_Tim(&$Array)
{
    $cnt = 0;
    foreach ($Array as $k => $v) {
      $cnt++;
      $Array[$v] = null;
    }
    $result = count($Array);

  return $result;
}






















