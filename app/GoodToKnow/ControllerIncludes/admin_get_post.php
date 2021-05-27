<?php

use GoodToKnow\Models\Post;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

global $db;
global $sessionMessage;
global $chosen_post_id;
global $post_object;


kick_out_nonadmins();

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$chosen_post_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);


$db = get_db();

$post_object = Post::find_by_id($db, $chosen_post_id);

if (!$post_object) {

    breakout(' EditMyPostEditor: Error 011299. ');

}