<?php

use function GoodToKnow\ControllerHelpers\date_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\timezone_form_field_prep;


global $timezone;
global $last;
global $next;


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
 * ALREADY taken care of above within call to timezone_form_field_prep().
 * Use $timezone to set the default timezone for the script to use.
 */


/**
 * Get `lastdate`.
 */

$lastdate = date_form_field_prep('lastdate');


/**
 * Get `nextdate`.
 */

$nextdate = date_form_field_prep('nextdate');


/**
 * We need these date strings to be split into day, month, year values.
 * While we're at it remove leading zeros.
 */

// First let's do it to $lastdate.

$words = explode('/', $lastdate);

$mm_last = (int)$words[0];

$dd_last = (int)$words[1];

$yyyy_last = (int)$words[2];

// Next let's do it to $nextdate.

$words = explode('/', $nextdate);

$mm_next = (int)$words[0];

$dd_next = (int)$words[1];

$yyyy_next = (int)$words[2];


/**
 * Now we're cooking with greece.
 */


/**
 * Get `lasthour`.
 */

$lasthour = integer_form_field_prep('lasthour', 0, 23);


/**
 * Get `nexthour`.
 */

$nexthour = integer_form_field_prep('nexthour', 0, 23);


/**
 * Get `lastminute`.
 */

$lastminute = integer_form_field_prep('lastminute', 0, 59);


/**
 * Get `nextminute`.
 */

$nextminute = integer_form_field_prep('nextminute', 0, 59);


/**
 * Get `lastsecond`.
 */

$lastsecond = integer_form_field_prep('lastsecond', 0, 59);


/**
 * Get `nextsecond`.
 */

$nextsecond = integer_form_field_prep('nextsecond', 0, 59);


/**
 * Get the timestamps $last and $next from the gathered data.
 */

$last = mktime($lasthour, $lastminute, $lastsecond, $mm_last, $dd_last, $yyyy_last);

$next = mktime($nexthour, $nextminute, $nextsecond, $mm_next, $dd_next, $yyyy_next);


/**
 * Never allow time to be 0.
 */

if ($last === 0) $last = 1546300800;
if ($next === 0) $next = 1546300800;
