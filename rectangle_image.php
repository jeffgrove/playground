<?php
/**
 * Created by IntelliJ IDEA.
 * User: jeffg
 * Date: 5/8/15
 * Time: 8:22 AM
 */

// ASSUMPTIONS:
// Grid laid out from left to right (X gets bigger going right)
// Grid laid out from bottom to top (Y gets bigger going up)


$currentPositionX = 8904;
$currentPositionY = 4217;

CONST imageWidth  = 1024;
CONST imageHeight = 768;

$midWidth  = imageWidth / 2;
$midHeight = imageHeight / 2;

$imageFilePattern = "image_cXXX_rYYY";

// If on the midpoint of a row or column, only need one element
$numRecsX = ($currentPositionX - $midWidth) % imageWidth == 0 ? 1 : 2;
$numRecsY = ($currentPositionY - $midHeight) % imageheight == 0 ? 1 : 2;


str_replace("YYY", $col, $imageFilePattern);
str_replace("XXX", $row, $imageFilePattern);