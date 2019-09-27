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
 * Get `lastdate`.
 */

$lastdate = date_form_field_prep('lastdate');


/**
 * Get `nextdate`.
 */

$nextdate = date_form_field_prep('nextdate');


/**
 * Get a timestamp $last from $lastdate.
 */

$last = get_timestamp_from_date($lastdate);


/**
 * Get a timestamp $next from $nextdate.
 */

$next = get_timestamp_from_date($nextdate);


/**
 * Get `lasthour`.
 */

$lasthour = integer_form_field_prep('lasthour', 0, 23);


/**
 * Get `nexthour`.
 */

$nexthour = integer_form_field_prep('nexthour', 0, 23);


/**
 * Update timestamp $last with $lasthour.
 */

$last += 3600 * $lasthour;


/**
 * Update timestamp $next with $nexthour.
 */

$next += 3600 * $nexthour;


/**
 * Get `lastminute`.
 */

$lastminute = integer_form_field_prep('lastminute', 0, 59);


/**
 * Get `nextminute`.
 */

$nextminute = integer_form_field_prep('nextminute', 0, 59);


/**
 * Update timestamp $last with $lastminute.
 */

$last += 60 * $lastminute;


/**
 * Update timestamp $next with $nextminute.
 */

$next += 60 * $nextminute;


/**
 * Get `lastsecond`.
 */

$lastsecond = integer_form_field_prep('lastsecond', 0, 59);


/**
 * Get `nextsecond`.
 */

$nextsecond = integer_form_field_prep('nextsecond', 0, 59);


/**
 * Update timestamp $last with $lastsecond.
 */

$last += $lastsecond;


/**
 * Update timestamp $next with $nextsecond.
 */

$next += $nextsecond;


/**
 * Never allow $time to be 0.
 */

if ($last === 0) $last = 1546300800;
if ($next === 0) $next = 1546300800;
