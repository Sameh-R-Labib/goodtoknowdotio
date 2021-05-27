<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Bitcoin;
use function GoodToKnow\ControllerHelpers\yes_no_form_field_prep;

class DeleteABitcoinRecordDelete
{
    function page()
    {
        /**
         * Here we will read the choice of whether or not to delete the bitcoin record. If yes then delete it.
         * On the other hand if no then reset some session variables and redirect to the home page.
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

        $bitcoin = Bitcoin::find_by_id($saved_int01);

        if (!$bitcoin) {

            breakout(' I was NOT able to find the bitcoin record. ');

        }


        $result = $bitcoin->delete();

        if (!$result) {

            breakout(' Unexpectedly I could not delete the bitcoin record. ');

        }


        // Report successful deletion of post.

        breakout(' I have deleted the ₿ record. ');
    }
}