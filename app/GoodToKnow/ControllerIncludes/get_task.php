<?php

use GoodToKnow\Models\Task;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $g;


/**
 * 1) Determines the id of the task record from 'choice' and stores it in $_SESSION['saved_int01'].
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

$_SESSION['saved_int01'] = $chosen_id;


/**
 * 2) Retrieve the task object with that id from the database.
 *    And, format its attributes for easy viewing.
 */

$g->object = Task::find_by_id($chosen_id);

if (!$g->object) {

    breakout(' Unexpectedly, I could not find that task. ');

}


/**
 * 3) Make sure that object belongs to this user.
 */

if ($g->object->user_id != $g->user_id) {

    breakout(' Error 46985422. ');

}