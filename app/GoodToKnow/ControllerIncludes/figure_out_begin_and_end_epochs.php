<?php

use function GoodToKnow\ControllerHelpers\date_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\timezone_form_field_prep;


global $g;


require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';
require_once CONTROLLERHELPERS . DIRSEP . 'date_form_field_prep.php';
require_once CONTROLLERHELPERS . DIRSEP . 'timezone_form_field_prep.php';


/**
 * Get `timezone`.
 */

$g->timezone = timezone_form_field_prep('timezone');


/**
 * ALREADY taken care of above within call to timezone_form_field_prep().
 * Use $timezone to set the default timezone for the script to use.
 */


/**
 * Get `begin_date`.
 */

$g->begin_date = date_form_field_prep('begin_date');


/**
 * Get `end_date`.
 */

$g->end_date = date_form_field_prep('end_date');


/**
 * We need these date strings to be split into day, month, year values.
 * While we're at it remove leading zeros.
 */

// First let's do it to $begin_date.

$words = explode('/', $g->begin_date);

$mm_begin = (int)$words[0];

$dd_begin = (int)$words[1];

$yyyy_begin = (int)$words[2];

// Next let's do it to $end_date.

$words = explode('/', $g->end_date);

$mm_end = (int)$words[0];

$dd_end = (int)$words[1];

$yyyy_end = (int)$words[2];


/**
 * Now we're cooking with greece.
 */


/**
 * Get `begin_hour`.
 */

$g->begin_hour = integer_form_field_prep('begin_hour', 0, 23);


/**
 * Get `end_hour`.
 */

$g->end_hour = integer_form_field_prep('end_hour', 0, 23);


/**
 * Get `begin_minute`.
 */

$g->begin_minute = integer_form_field_prep('begin_minute', 0, 59);


/**
 * Get `end_minute`.
 */

$g->end_minute = integer_form_field_prep('end_minute', 0, 59);


/**
 * Get `begin_second`.
 */

$g->begin_second = integer_form_field_prep('begin_second', 0, 59);


/**
 * Get `end_second`.
 */

$g->end_second = integer_form_field_prep('end_second', 0, 59);


/**
 * Get the timestamps $g->begin and $g->end from the gathered data.
 */

$g->begin = mktime($g->begin_hour, $g->begin_minute, $g->begin_second, $mm_begin, $dd_begin, $yyyy_begin);

$g->end = mktime($g->end_hour, $g->end_minute, $g->end_second, $mm_end, $dd_end, $yyyy_end);


/**
 * Never allow time to be 0.
 */

if ($g->begin === 0) $g->begin = 1546300800;
if ($g->end === 0) $g->end = 1546300800;
