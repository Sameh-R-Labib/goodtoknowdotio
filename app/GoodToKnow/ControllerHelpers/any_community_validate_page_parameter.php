<?php

namespace GoodToKnow\ControllerHelpers;

use GoodToKnow\Models\community;


function any_community_validate_page_parameter()
{
    /**
     * This function validates $g->id. $g->id is supposed to be a valid
     * community id. $g->id comes from a page() parameter.
     *
     * If $g->id this function causes a breakout.
     */


    global $g;


    if (!is_int($g->id) or $g->id < 1) {

        breakout(' Error 4053236343: Community id is either not int or is negative int. ');

    }

    $community_array = community::find_all();

    $is_found = false;

    foreach ($community_array as $value) {

        if ($value->id == $g->id) {

            $is_found = true;
            break;

        }
    }

    if (!$is_found) {

        breakout(' Error 1051231313: Value is not valid. ');

    }
}