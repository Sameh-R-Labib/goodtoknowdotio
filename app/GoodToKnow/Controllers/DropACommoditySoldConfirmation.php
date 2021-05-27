<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\CommoditySold;
use function GoodToKnow\ControllerHelpers\yes_no_form_field_prep;

class DropACommoditySoldConfirmation
{
    function page()
    {
        /**
         * Here we will read the choice of whether or not to delete the record. If yes then
         * delete it. On the other hand if no then reset some session variables and redirect to the home page.
         */


        global $db;
        global $sessionMessage;
        global $saved_int01;


        kick_out_loggedoutusers();


        /**
         * Do nothing if user changed mind.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'yes_no_form_field_prep.php';

        $choice = yes_no_form_field_prep('choice');

        if ($choice == "no") {

            breakout(' Nothing was deleted. ');

        }


        /**
         * Delete the record.
         */

        $db = get_db();

        $object = CommoditySold::find_by_id($db, $saved_int01);

        if (!$object) {

            breakout(' I was not able to find the record. ');

        }

        $result = $object->delete($db);

        if (!$result) {

            breakout(' Unexpectedly I could not delete the record. ');

        }


        // Report successful deletion of post.

        breakout(' Your commodity sold has just been deleted. ');
    }
}