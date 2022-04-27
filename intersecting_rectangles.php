<?php

/**
 * A simple point in X,Y land
 */
class Point {
  public $x = null;
  public $y = null;

  /**
   * @param float $x
   * @param float $y
   */
  public function __construct(float $x, float $y) {
    $this->x = $x;
    $this->y = $y;
  }
}

/**
 * A simple rectangle in X,Y point-land
 */
class Rectangle {
  public $lowerLeft = null;
  public $upperRight = null;

  /**
   * @param Point $lowerLeft
   * @param Point $upperRight
   * @throws Exception
   */
  public function __construct(Point $lowerLeft, Point $upperRight) {
    $this->lowerLeft = $lowerLeft;
    $this->upperRight = $upperRight;

    // Validate that lower left is less than upper right
    if ($this->lowerLeft->x > $this->upperRight->x || $this->lowerLeft->y > $this->upperRight->y) {
      throw new Exception('Invalid Rectangle!');
    }
  }

  /**
   * Print helper
   *
   * @return void
   */
  public function print() {
    print "({$this->lowerLeft->x}, {$this->lowerLeft->y}), ({$this->upperRight->x}, {$this->upperRight->y})\n";
  }

  /**
   * Do the rectangles intersect?
   *
   * @param Rectangle $r1
   * @param Rectangle $r2
   * @return int
   */
  public static function isOverlappingRectangle(Rectangle $r1, Rectangle $r2) {
    //   A line and a point could be considered valid rectangles in this model
    //   To do that, adjust all the ">" and "<" to ">=" and "<="

    /** THIS IS THE KEY TOPIC THAT I WANT TO DISCUSS!! */
    // There is an overlap if all of the following are true
    return ($r1->lowerLeft->x < $r2->upperRight->x && $r1->upperRight->x > $r2->lowerLeft->x
      && $r1->lowerLeft->y < $r2->upperRight->y && $r1->upperRight->y > $r2->lowerLeft->y) ? 1 : 0;
  }

  /**
   * Get the overlapping rectangle (or null)
   *
   * @param Rectangle $r1
   * @param Rectangle $r2
   * @return Rectangle|null
   * @throws Exception
   */
  public static function getOverlappingRectangle(Rectangle $r1, Rectangle $r2) {
    //   A line and a point could be considered valid rectangles in this model
    //   To do that, adjust all the ">" and "<" to ">=" and "<="
    $newRect = null;

    if (self::isOverlappingRectangle($r1, $r2)) {
      // Get the largest X and Y values from both Rects lower left
      $lowerLeft_x = max([$r1->lowerLeft->x, $r2->lowerLeft->x]);
      $lowerLeft_y = max([$r1->lowerLeft->y, $r2->lowerLeft->y]);

      // Get the smallest X and Y values from both Rects upper right
      $upperRight_x = min([$r1->upperRight->x, $r2->upperRight->x]);
      $upperRight_y = min([$r1->upperRight->y, $r2->upperRight->y]);

      // If this is a valid rectangle, it is the overlap rectangle
      //   A line and a point are valid rectangle subsets in this model BUT
      //   that is easy to adjust by making the ">=" just a ">"
      if ($upperRight_x > $lowerLeft_x &&  $upperRight_y >= $lowerLeft_y) {
        $newRect = new Rectangle(new Point($lowerLeft_x, $lowerLeft_y), new Point($upperRight_x, $upperRight_y));
      }


    }
    return $newRect;
  }
}

$testCases = [
  'Simple Overlap' => [
    'r1_ll_x' => 1,
    'r1_ll_y' => 1,
    'r1_ur_x' => 10,
    'r1_ur_y' => 10,
    'r2_ll_x' => 5,
    'r2_ll_y' => 5,
    'r2_ur_x' => 15,
    'r2_ur_y' => 15,
    'is_overlap' => 1
  ],
  'Identical' => [
    'r1_ll_x' => 1,
    'r1_ll_y' => 1,
    'r1_ur_x' => 10,
    'r1_ur_y' => 10,
    'r2_ll_x' => 1,
    'r2_ll_y' => 1,
    'r2_ur_x' => 10,
    'r2_ur_y' => 10,
    'is_overlap' => 1
  ],
  'X Overlap' => [
    'r1_ll_x' => 1,
    'r1_ll_y' => 1,
    'r1_ur_x' => 10,
    'r1_ur_y' => 10,
    'r2_ll_x' => 7,
    'r2_ll_y' => 1,
    'r2_ur_x' => 25,
    'r2_ur_y' => 10,
    'is_overlap' => 1
  ],
  'Y Overlap' => [
    'r1_ll_x' => 1,
    'r1_ll_y' => 1,
    'r1_ur_x' => 10,
    'r1_ur_y' => 10,
    'r2_ll_x' => 1,
    'r2_ll_y' => 7,
    'r2_ur_x' => 10,
    'r2_ur_y' => 25,
    'is_overlap' => 1
  ],
  'All Overlap' => [
    'r1_ll_x' => 1,
    'r1_ll_y' => 1,
    'r1_ur_x' => 10,
    'r1_ur_y' => 10,
    'r2_ll_x' => 3,
    'r2_ll_y' => 3,
    'r2_ur_x' => 5,
    'r2_ur_y' => 5,
    'is_overlap' => 1
  ],
  'No Overlap' => [
    'r1_ll_x' => 1,
    'r1_ll_y' => 1,
    'r1_ur_x' => 10,
    'r1_ur_y' => 10,
    'r2_ll_x' => 11,
    'r2_ll_y' => 11,
    'r2_ur_x' => 20,
    'r2_ur_y' => 20,
    'is_overlap' => 0
  ],
  'Line Overlap' => [
    'r1_ll_x' => 1,
    'r1_ll_y' => 1,
    'r1_ur_x' => 10,
    'r1_ur_y' => 10,
    'r2_ll_x' => 10,
    'r2_ll_y' => 3,
    'r2_ur_x' => 20,
    'r2_ur_y' => 9,
    'is_overlap' => 0
  ],
  'Point Overlap' => [
    'r1_ll_x' => 1,
    'r1_ll_y' => 1,
    'r1_ur_x' => 10,
    'r1_ur_y' => 10,
    'r2_ll_x' => 10,
    'r2_ll_y' => 10,
    'r2_ur_x' => 20,
    'r2_ur_y' => 20,
    'is_overlap' => 0
  ],
];

foreach ($testCases AS $testName => $testCase) {
  print("Running {$testName}\n");
  if (!empty($testCase)) {
    $r1 = new Rectangle(new Point($testCase['r1_ll_x'], $testCase['r1_ll_y']), new Point($testCase['r1_ur_x'], $testCase['r1_ur_y']));
    $r2 = new Rectangle(new Point($testCase['r2_ll_x'], $testCase['r2_ll_y']), new Point($testCase['r2_ur_x'], $testCase['r2_ur_y']));
    $shouldOverlap = $testCase['is_overlap'];

    print("\t");
    $r1->print();
    print("\t");
    $r2->print();

    $isOverlap = Rectangle::isOverlappingRectangle($r1, $r2);
    $rx = Rectangle::getOverlappingRectangle($r1, $r2);

    if ($isOverlap && $shouldOverlap && $rx != null) {
      print("Test Passed!\n");
      print("\tisOverlap = {$isOverlap}, shouldOverlap = {$shouldOverlap}\n");
      print("\t");
      $rx->print();
    } else if (!$isOverlap && !$shouldOverlap && $rx == null) {
      print("Text Passed!\n");
      print("\tisOverlap = {$isOverlap}, shouldOverlap = {$shouldOverlap}, intersecting rectangle is null\n");
    } else {
      print("Test Failed\n");
      print("\tisOverlap = {$isOverlap}, shouldOverlap = {$shouldOverlap}\n");
      if ($rx == null) {
        print("intersecting rectangle is null\n");
      } else {
        print("\t");
        $rx->print();
      }
    }
  } else {
    print("\tNo data\n");
  }
  print("\n");
}
