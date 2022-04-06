<?php

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $g;


require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$g->chosen_topic_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);


if (!array_key_exists($g->chosen_topic_id, $g->special_topic_array)) {

    breakout(' Unexpected error: topic id not found in topic array. ');

}


$_SESSION['saved_int01'] = $g->chosen_topic_id;
