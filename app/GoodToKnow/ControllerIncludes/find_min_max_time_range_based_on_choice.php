<?php


global $g;


/**
 * 1) Validate the submitted choice of time range (A,B,C,D,E.)
 */

$values = ['A', 'B', 'C', 'D', 'E'];

if (!in_array($g->s, $values)) {

    breakout(' You choice is invalid or you did not make one. ');

}


/**
 * 2) Calculate the min and max times of the requested range.
 */

$min = 0;
$max = 0;

switch ($g->s) {
    case 'A':
        // Last 30 days
        $min = time() - 2592000;
        $max = time() + 315569520;
        break;
    case 'B':
        // 30 - 60 day range
        $min = time() - 5184000;
        $max = time() - 2592000;
        break;
    case 'C':
        // 60 - 90 day range
        $min = time() - 7776000;
        $max = time() - 5184000;
        break;
    case 'D':
        // Beyond 90 days
        $min = 1483259485;
        $max = time() - 7776000;
        break;
    case 'E':
        // All
        $min = 1483259485;
        $max = time() + 315569520;
        break;
    default:
        breakout(' Err: 28218 Unexpectedly the switch statement failed. ');
}


/**
 * 3) Store the min and max in session variables.
 */

$_SESSION['saved_int01'] = $min;

$_SESSION['saved_int02'] = $max;