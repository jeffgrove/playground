<?php

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

class Rectangle {
  public $lowerLeft;
  public $upperRight;

  public function __construct(Point $lowerLeft, Point $upperRight) {
    $this->lowerLeft = $lowerLeft;
    $this->upperRight = $upperRight;
  }

  public static function getOverlappingRectangle(Rectangle $r1, Rectangle $r2) {
    // Get the largest X and Y values from both Rects lower left
    $lowerLeft_x = max([$r1->lowerLeft->x, $r2->lowerLeft->x]);
    $lowerLeft_y = max([$r1->lowerLeft->y, $r2->lowerLeft->y]);

    // Get the smallest X and Y values from both Rects upper right
    $upperRight_x = min([$r1->upperRight->x, $r2->upperRight->x]);
    $upperRight_y = min([$r1->upperRight->y, $r2->upperRight->y]);

    // If this is a valid rectangle, it is the overlap rectangle
    //   A line and a point are valid rectangle subsets in this model BUT
    //   that is easy to adjust by making the ">=" just a ">"
    $newRect = null;
    if ($upperRight_x > $lowerLeft_x &&  $upperRight_y >= $lowerLeft_y) {
      $newRect = new Rectangle(new Point($lowerLeft_x, $lowerLeft_y), new Point($upperRight_x, $upperRight_y));
    }

    return $newRect;
  }
}

