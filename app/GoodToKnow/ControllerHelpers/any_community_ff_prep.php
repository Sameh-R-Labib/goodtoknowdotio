<?php

namespace GoodToKnow\ControllerHelpers;

use GoodToKnow\Models\Community;
use mysqli;

/**
 * @return int
 */
function any_community_ff_prep(): int
{
    /**
     * Returns a community id if the POST variable for $field_name is a valid community id.
     * Here any existing community id is considered a valid one.
     */

    global $db;

    require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

    $id = integer_form_field_prep('choice', 1, PHP_INT_MAX);


    /**
     * Make sure the submitted id is one of the existing community ids.
     */

    $community_array = Community::find_all($db);

    $is_found = false;

    foreach ($community_array as $value) {

        if ($value->id == $id) {

            $is_found = true;
            break;

        }
    }

    if (!$is_found) {

        breakout(' Value is not valid. ');

    }

    return $id;
}