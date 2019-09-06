<?php

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

global $special_topic_array;
global $sessionMessage;

kick_out_loggedoutusers();

kick_out_onabort();

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$chosen_topic_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

if (!array_key_exists($chosen_topic_id, $special_topic_array)) {

    breakout(' Unexpected error: topic id not found in topic array. ');

}

$_SESSION['saved_int01'] = $chosen_topic_id;
