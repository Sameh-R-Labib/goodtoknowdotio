<?php

namespace GoodToKnow\ControllerHelpers;

use GoodToKnow\Models\Post;

/**
 * @param string $field_name
 * @param $user_id
 * @return object
 */
function post_object_for_owner_prep(string $field_name, $user_id): object
{
    global $db;


    /**
     * Returns a Post object belonging to the user.
     * Also saves the post id in the session.
     */


    require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

    $chosen_post_id = integer_form_field_prep($field_name, 1, PHP_INT_MAX);


    $post_object = Post::find_by_id($chosen_post_id);

    if (!$post_object) {

        breakout(' Error 011299. ');

    }

    if ($post_object->user_id != $user_id) {

        breakout(' You can\'t edit or delete this post. ');

    }


    $_SESSION['saved_int02'] = $chosen_post_id;


    return $post_object;
}