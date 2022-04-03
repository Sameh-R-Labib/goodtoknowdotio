<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\possible_tax_deduction;
use function GoodToKnow\ControllerHelpers\yes_no_form_field_prep;

class wipe_out_a_possible_tax_deduction_confirmation
{
    function page()
    {
        /**
         * Here we will read the choice of whether
         * to delete the record. If yes then delete it.
         * On the other hand if no then reset some session
         * variables and redirect to the home page.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


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

        get_db();

        $object = possible_tax_deduction::find_by_id($g->saved_int01);

        if (!$object) {

            breakout(' I was not able to find the record. ');

        }

        $result = $object->delete();

        if (!$result) {

            breakout(' Unexpectedly I could not delete the record. ');

        }


        // Report successful deletion of post.

        breakout(' I have deleted the Possible Tax Deduction record. ');
    }
}