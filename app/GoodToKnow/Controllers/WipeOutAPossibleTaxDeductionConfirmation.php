<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\PossibleTaxDeduction;
use function GoodToKnow\ControllerHelpers\yes_no_form_field_prep;

class WipeOutAPossibleTaxDeductionConfirmation
{
    function page()
    {
        /**
         * Here we will read the choice of whether
         * or not to delete the record. If yes then
         * delete it. On the other hand if no then reset
         * some session variables and redirect to the home page.
         */


        global $gtk;
        global $db;


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

        $object = PossibleTaxDeduction::find_by_id($gtk->saved_int01);

        if (!$object) {

            breakout(' I was not able to find the record. ');

        }

        $result = $object->delete();

        if (!$result) {

            breakout(' Unexpectedly I could not delete the record. ');

        }


        // Report successful deletion of post.

        breakout(' I have deleted the 🤔 Tax ✍🏽🔽. ');
    }
}