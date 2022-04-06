<?php

use GoodToKnow\Models\commodity;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

global $g;


/**
 * Determines the id of the commodity record from $_POST['choice'] and stores it in $_SESSION['saved_int01'].
 */

require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

$chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

$_SESSION['saved_int01'] = (int)$chosen_id;


/**
 * Retrieve the commodity object with that id from the database.
 */

$g->commodity_object = commodity::find_by_id($chosen_id);

if (!$g->commodity_object) {

    breakout(' Unexpectedly I could not find that commodity record. ');

}


/**
 * Verify that this object belongs to the user.
 */

if ($g->commodity_object->user_id != $g->user_id) {

    breakout(' Error 8006667. ');

}
