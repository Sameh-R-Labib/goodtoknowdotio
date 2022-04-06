<?php

namespace GoodToKnow\ControllerHelpers;

use GoodToKnow\Models\post;

/**
 * @param string $field_name
 * @return object
 */
function post_object_for_owner_prep(string $field_name): object
{
    global $g;


    /**
     * Returns a post object belonging to the current user.
     * Also saves the post id in the session.
     */


    require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

    $g->chosen_post_id = integer_form_field_prep($field_name, 1, PHP_INT_MAX);


    $g->post_object = post::find_by_id($g->chosen_post_id);

    if (!$g->post_object) {

        breakout(' Error 011299. ');

    }

    if ($g->post_object->user_id != $g->user_id) {

        breakout(' You can\'t edit or delete this post. ');

    }


    $_SESSION['saved_int02'] = $g->chosen_post_id;


    return $g->post_object;
}