<?php

use function GoodToKnow\ControllerHelpers\checkbox_section_form_field_prep;


global $g;


/**
 * Now we know the ids of the communities the administrator
 * wants the user to belong to. The goal is to assign these
 * communities to the user.
 */

/**
 * $_POST array looks something like this:
 *
 * array(5) {
 *   ["choice-1"]=> string(1) "3"
 *   ["choice-2"]=> string(1) "8"
 *   ["choice-3"]=> string(2) "12"
 *   ["choice-4"]=> string(2) "15"
 *   ["submit"]=> string(6) "Submit"
 * }
 */

/**
 * Instead what we need is an array like this:
 *
 * array(4) {
 *   [0]=> string(1) "3"
 *   [1]=> string(1) "8"
 *   [2]=> string(2) "12"
 *   [3]=> string(2) "15"
 * }
 */

// Begin new code

require_once CONTROLLERHELPERS . DIRSEP . 'checkbox_section_form_field_prep.php';

$g->submitted_community_ids_array = checkbox_section_form_field_prep('choice-');


if (empty($g->submitted_community_ids_array)) {

    breakout(' You did not submit any community ids. ');

}


/**
 * Make sure the data is numeric.
 */

foreach ($g->submitted_community_ids_array as $item) {

    if (!is_numeric($item)) {

        breakout(' Unexpectedly one or more values turned out to be non-numeric. ');

    }

}
