<?php

use function GoodToKnow\ControllerHelpers\date_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;


/**
 * These includes may be redundant. But that's okay!
 */

require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

require_once CONTROLLERHELPERS . DIRSEP . 'date_form_field_prep.php';


/**
 * Get `timezone`.
 */

$timezone = standard_form_field_prep('timezone', 2, 60);


/**
 * Use $timezone to set the default timezone for the script to use.
 */

if (!date_default_timezone_set($timezone)) {

    breakout(' Invalid PHP time zone submitted 👎🏽. ');

}


/**
 * Get `date`.
 */

$date = date_form_field_prep('date');


/**
 * We need the date string to be split into day, month, year values.
 * While we're at it remove leading zeros.
 */

$words = explode('/', $date);

$mm = ltrim($words[0], '0');

$dd = ltrim($words[1], '0');

$yyyy = $words[2];

// Convert these to integers.

$mm = (int)$mm;

$dd = (int)$dd;

$yyyy = (int)$yyyy;


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
