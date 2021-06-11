<?php

use GoodToKnow\Models\Bitcoin;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

global $g;


/**
 * Determines the id of the bitcoin record from $_POST['choice'] and stores it in $_SESSION['saved_int01'].
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

$_SESSION['saved_int01'] = $chosen_id;


/**
 * Retrieve the Bitcoin object with that id from the database.
 */

$g->bitcoin_object = Bitcoin::find_by_id($chosen_id);

if (!$g->bitcoin_object) {

    breakout(' Unexpectedly I could not find that bitcoin record. ');

}


/**
 * Verify that this object belongs to the user.
 */

if ($g->bitcoin_object->user_id != $g->user_id) {

    breakout(' Error 8006667. ');

}
