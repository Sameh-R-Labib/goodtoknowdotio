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
 * Get `last_date`.
 */

$g->last_date = date_form_field_prep('last_date');


/**
 * Get `next_date`.
 */

$g->next_date = date_form_field_prep('next_date');


/**
 * We need these date strings to be split into day, month, year values.
 * While we're at it remove leading zeros.
 */

// First let's do it to $last_date.

$words = explode('/', $g->last_date);

$mm_last = (int)$words[0];

$dd_last = (int)$words[1];

$yyyy_last = (int)$words[2];

// Next let's do it to $next_date.

$words = explode('/', $g->next_date);

$mm_next = (int)$words[0];

$dd_next = (int)$words[1];

$yyyy_next = (int)$words[2];


/**
 * Now we're cooking with greece.
 */


/**
 * Get `last_hour`.
 */

$g->last_hour = integer_form_field_prep('last_hour', 0, 23);


/**
 * Get `next_hour`.
 */

$g->next_hour = integer_form_field_prep('next_hour', 0, 23);


/**
 * Get `last_minute`.
 */

$g->last_minute = integer_form_field_prep('last_minute', 0, 59);


/**
 * Get `next_minute`.
 */

$g->next_minute = integer_form_field_prep('next_minute', 0, 59);


/**
 * Get `last_second`.
 */

$g->last_second = integer_form_field_prep('last_second', 0, 59);


/**
 * Get `next_second`.
 */

$g->next_second = integer_form_field_prep('next_second', 0, 59);


/**
 * Get the timestamps $g->last and $g->next from the gathered data.
 */

$g->last = mktime($g->last_hour, $g->last_minute, $g->last_second, $mm_last, $dd_last, $yyyy_last);

$g->next = mktime($g->next_hour, $g->next_minute, $g->next_second, $mm_next, $dd_next, $yyyy_next);


/**
 * Never allow time to be 0.
 */

if ($g->last === 0) $g->last = 1546300800;
if ($g->next === 0) $g->next = 1546300800;
