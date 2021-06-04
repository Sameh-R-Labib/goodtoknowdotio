<?php

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $app_state;
global $chosen_topic_id;


kick_out_loggedoutusers();


require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$chosen_topic_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);


if (!array_key_exists($chosen_topic_id, $app_state->special_topic_array)) {

    breakout(' Unexpected error: topic id not found in topic array. ');

}


$_SESSION['saved_int01'] = $chosen_topic_id;
