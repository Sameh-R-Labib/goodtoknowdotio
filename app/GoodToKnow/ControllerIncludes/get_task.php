<?php

use GoodToKnow\Models\Task;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $db;
global $gtk;
global $object;


kick_out_loggedoutusers();


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

$db = get_db();

$object = Task::find_by_id($chosen_id);

if (!$object) {

    breakout(' Unexpectedly, I could not find that task. ');

}


/**
 * 3) Make sure that object belongs to this user.
 */

if ($object->user_id != $gtk->user_id) {

    breakout(' Error 46985422. ');

}