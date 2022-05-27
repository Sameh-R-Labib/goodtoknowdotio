<?php

use GoodToKnow\Models\task;


global $g;


/**
 * 1) Determines the id of the task record and stores it in $_SESSION['saved_int01'].
 */

$_SESSION['saved_int01'] = (int)$g->id;


/**
 * 2) Retrieve the task object with that id from the database.
 *    And, format its attributes for easy viewing.
 */

$g->object = task::find_by_id($g->id);

if (!$g->object) {

    breakout(' Err: 662466 Unexpectedly, I could not find that task. ');

}


/**
 * 3) Make sure that object belongs to this user.
 */

if ($g->object->user_id != $g->user_id) {

    breakout(' Error 46985422. ');

}