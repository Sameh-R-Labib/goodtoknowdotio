<?php

use function GoodToKnow\ControllerHelpers\date_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\timezone_form_field_prep;

global $time;
global $timezone;

/**
 * These includes may be redundant. But that's okay!
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';
require_once CONTROLLERHELPERS . DIRSEP . 'date_form_field_prep.php';
require_once CONTROLLERHELPERS . DIRSEP . 'timezone_form_field_prep.php';


/**
 * Get `timezone`.
 */

$timezone = timezone_form_field_prep('timezone');


/**
 * ALREADY taken care of above.
 * Use $timezone to set the default timezone for the script to use.
 */



/**
 * Get `date`.
 */

$date = date_form_field_prep('date');


/**
 * We need the date string to be split into day, month, year values.
 * While we're at it remove leading zeros.
 */

$words = explode('/', $date);

$mm = (int)$words[0];

$dd = (int)$words[1];

$yyyy = (int)$words[2];


/**
 * Now we're cooking with greece.
 */


/**
 * Get `hour`.
 */

$hour = integer_form_field_prep('hour', 0, 23);


/**
 * Get `minute`.
 */

$minute = integer_form_field_prep('minute', 0, 59);


/**
 * Get `second`.
 */

$second = integer_form_field_prep('second', 0, 59);


/**
 * Get the timestamp $time from the gathered data.
 */

$time = mktime($hour, $minute, $second, $mm, $dd, $yyyy);


/**
 * Never allow $time to be 0.
 */

if ($time === 0) $time = 1546300800;
