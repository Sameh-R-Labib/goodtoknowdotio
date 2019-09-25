<?php

use function GoodToKnow\ControllerHelpers\date_form_field_prep;
use function GoodToKnow\ControllerHelpers\get_timestamp_from_date;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;


/**
 * These includes may be redundant. But that's okay!
 */

require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

require_once CONTROLLERHELPERS . DIRSEP . 'date_form_field_prep.php';

require_once CONTROLLERHELPERS . DIRSEP . 'get_timestamp_from_date.php';


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
 * Get a timestamp from `date`.
 */

$time = get_timestamp_from_date($date);


/**
 * Get `hour`.
 */

$hour = integer_form_field_prep('hour', 0, 23);


/**
 * Update $timestamp with $hour.
 */

$time += 3600 * $hour;


/**
 * Get `minute`.
 */

$minute = integer_form_field_prep('minute', 0, 59);


/**
 * Update $timestamp with $minute.
 */

$time += 60 * $minute;


/**
 * Get `second`.
 */

$second = integer_form_field_prep('second', 0, 59);


/**
 * Update $timestamp with $second.
 */

$time += $second;


/**
 * Never allow $time to be 0.
 */


if ($time === 0) $time = 1546300800;
