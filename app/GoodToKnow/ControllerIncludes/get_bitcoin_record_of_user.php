<?php

use GoodToKnow\Models\Bitcoin;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

global $db;
global $app_state;
global $timezone;
global $bitcoin_object;


kick_out_loggedoutusers();


/**
 * Determines the id of the bitcoin record from $_POST['choice'] and stores it in $_SESSION['saved_int01'].
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

$_SESSION['saved_int01'] = $chosen_id;


/**
 * Retrieve the Bitcoin object with that id from the database.
 */

$db = get_db();

$bitcoin_object = Bitcoin::find_by_id($chosen_id);

if (!$bitcoin_object) {

    breakout(' Unexpectedly I could not find that bitcoin record. ');

}


/**
 * Verify that this object belongs to the user.
 */

if ($bitcoin_object->user_id != $app_state->user_id) {

    breakout(' Error 8006667. ');

}
