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
 * ALREADY taken care of above within call to timezone_form_field_prep().
 * Use $timezone to set the default timezone for the script to use.
 */


/**
 * Get `time_bought_date`.
 */

$g->time_bought_date = date_form_field_prep('time_bought_date');


/**
 * Get `time_sold_date`.
 */

$g->time_sold_date = date_form_field_prep('time_sold_date');


/**
 * We need these date strings to be split into day, month, year values.
 * While we're at it remove leading zeros.
 */

// First let's do it to $time_bought_date.

$words = explode('/', $g->time_bought_date);

$mm_time_bought = (int)$words[0];

$dd_time_bought = (int)$words[1];

$yyyy_time_bought = (int)$words[2];

// Next let's do it to $time_sold_date.

$words = explode('/', $g->time_sold_date);

$mm_time_sold = (int)$words[0];

$dd_time_sold = (int)$words[1];

$yyyy_time_sold = (int)$words[2];


/**
 * Now we're cooking with greece.
 */


/**
 * Get `time_bought_hour`.
 */

$g->time_bought_hour = integer_form_field_prep('time_bought_hour', 0, 23);


/**
 * Get `time_sold_hour`.
 */

$g->time_sold_hour = integer_form_field_prep('time_sold_hour', 0, 23);


/**
 * Get `time_bought_minute`.
 */

$g->time_bought_minute = integer_form_field_prep('time_bought_minute', 0, 59);


/**
 * Get `time_sold_minute`.
 */

$g->time_sold_minute = integer_form_field_prep('time_sold_minute', 0, 59);


/**
 * Get `time_bought_second`.
 */

$g->time_bought_second = integer_form_field_prep('time_bought_second', 0, 59);


/**
 * Get `time_sold_second`.
 */

$g->time_sold_second = integer_form_field_prep('time_sold_second', 0, 59);


/**
 * Get the timestamps $g->time_bought and $g->time_sold from the gathered data.
 */

$g->time_bought = mktime($g->time_bought_hour, $g->time_bought_minute, $g->time_bought_second, $mm_time_bought, $dd_time_bought, $yyyy_time_bought);

$g->time_sold = mktime($g->time_sold_hour, $g->time_sold_minute, $g->time_sold_second, $mm_time_sold, $dd_time_sold, $yyyy_time_sold);


/**
 * Never allow time to be 0.
 */

if ($g->time_bought === 0) $g->time_bought = 1546300800;
if ($g->time_sold === 0) $g->time_sold = 1546300800;
