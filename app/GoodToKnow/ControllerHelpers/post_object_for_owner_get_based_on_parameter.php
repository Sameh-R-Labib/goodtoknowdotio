<?php

namespace GoodToKnow\ControllerHelpers;

use GoodToKnow\Models\post;

function post_object_for_owner_get_based_on_parameter()
{
    global $g;


    if (!is_int($g->id) or $g->id < 1) {

        breakout(' Error 489878443: Post id is either not int or is negative int. ');

    }


    $g->post_object = post::find_by_id($g->id);

    if (!$g->post_object) {

        breakout(' Error 000299. ');

    }

    if ($g->post_object->user_id != $g->user_id) {

        breakout(" You can't edit or delete this (not yours) post. ");

    }


    $_SESSION['saved_int02'] = $g->id;
}