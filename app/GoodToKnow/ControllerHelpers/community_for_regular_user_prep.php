<?php

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

/**
 * @param string $field_name
 * @return int
 */
function community_for_regular_user_prep(string $field_name): int
{
    /**
     * Returns a community id or exits with a message.
     *
     * It will exit if the id is not one of the users ids as found in $app_state->special_community_array.
     */


    global $app_state;


    require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

    // int(10) in mysql has max 4294967295

    $chosen_id = integer_form_field_prep($field_name, 1, 4294967295);


    /**
     * Make sure the submitted choice is valid for this user.
     */

    $is_found = false;

    if (array_key_exists($chosen_id, $app_state->special_community_array)) $is_found = true;

    if (!$is_found) {

        breakout(' The community id you submitted is not valid. ');

    }

    return $chosen_id;
}