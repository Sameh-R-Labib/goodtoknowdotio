<?php

use GoodToKnow\Models\Post;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

global $sessionMessage;

kick_out_nonadmins();

$db = get_db();

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$chosen_post_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

$post_object = Post::find_by_id($db, $sessionMessage, $chosen_post_id);

if (!$post_object) {

    breakout(' EditMyPostEditor: Error 011299. ');

}