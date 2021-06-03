<?php

use GoodToKnow\Models\CommoditySold;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


global $db;
global $app_state;
global $object;


kick_out_loggedoutusers();


/**
 * 1) Store the submitted commodities_sold id in the session.
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

$_SESSION['saved_int01'] = $id;


/**
 * 2) Retrieve the commodities_sold object with that id from the database.
 */

$db = get_db();

$object = CommoditySold::find_by_id($id);

if (!$object) {

    breakout(' Unexpectedly, I could not find that commodity sold. ');

}


/**
 * 3) Make sure the object belongs to this user.
 */

if ($object->user_id != $app_state->user_id) {

    breakout(' Error 01244161. ');

}
