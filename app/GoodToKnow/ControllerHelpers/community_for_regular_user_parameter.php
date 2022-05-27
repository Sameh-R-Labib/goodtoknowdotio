<?php

namespace GoodToKnow\ControllerHelpers;

/**
 * @return void
 */
function community_for_regular_user_parameter()
{
    global $g;


    /**
     * $g->id is the id of the chosen community.
     */


    /**
     * Make sure the submitted choice is valid for this user.
     */

    $is_found = false;

    if (array_key_exists($g->id, $g->special_community_array)) $is_found = true;

    if (!$is_found) {

        breakout(' Err: 243817 The community id you submitted is not valid. ');

    }
}