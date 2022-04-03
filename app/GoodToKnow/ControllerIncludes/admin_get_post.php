<?php

use GoodToKnow\Models\post;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $g;


require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$g->chosen_post_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

$g->post_object = post::find_by_id($g->chosen_post_id);

if (!$g->post_object) {

    breakout(' edit_my_post_editor: Error 011299. ');

}