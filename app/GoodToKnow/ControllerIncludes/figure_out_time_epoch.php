<?php

use function GoodToKnow\ControllerHelpers\date_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\timezone_form_field_prep;


global $g;


/**
 * These includes may be redundant. But that's okay!
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';
require_once CONTROLLERHELPERS . DIRSEP . 'date_form_field_prep.php';
require_once CONTROLLERHELPERS . DIRSEP . 'timezone_form_field_prep.php';


/**
 * Get `timezone`.
 */

$g->timezone = timezone_form_field_prep('timezone');


/**
 * ALREADY taken care of above.
 * Use $timezone to set the default timezone for the script to use.
 */



/**
 * Get `date`.
 */

$g->date = date_form_field_prep('date');


/**
 * We need the date string to be split into day, month, year values.
 * While we're at it remove leading zeros.
 */

$words = explode('/', $g->date);

$mm = (int)$words[0];

$dd = (int)$words[1];

$yyyy = (int)$words[2];


/**
 * Now we're cooking with greece.
 */


/**
 * Get `hour`.
 */

$g->hour = integer_form_field_prep('hour', 0, 23);


/**
 * Get `minute`.
 */

$g->minute = integer_form_field_prep('minute', 0, 59);


/**
 * Get `second`.
 */

$g->second = integer_form_field_prep('second', 0, 59);


/**
 * Get the timestamp $g->time from the gathered data.
 */

$g->time = mktime($g->hour, $g->minute, $g->second, $mm, $dd, $yyyy);


/**
 * Never allow $g->time to be 0.
 */

if ($g->time === 0) $g->time = 1546300800;
