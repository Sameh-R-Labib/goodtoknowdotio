<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use GoodToKnow\Models\PossibleTaxDeduction;

class WipeOutAPossibleTaxDeductionDelete
{
    function page()
    {
        /**
         * 1) Store the submitted possible_tax_deduction record id in the session.
         * 2) Retrieve the possible_tax_deduction object with that id from the database.
         * 3) Present a form which is populated with data from the possible_tax_deduction object
         *    and asks for approval for deletion to proceed.
         */

        global $sessionMessage;

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * 1) Store the submitted possible_tax_deduction record id in the session.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        $_SESSION['saved_int01'] = $chosen_id;


        /**
         * 2) Retrieve the possible_tax_deduction object with that id from the database.
         */

        $db = get_db();

        $object = PossibleTaxDeduction::find_by_id($db, $sessionMessage, $chosen_id);

        if (!$object) {

            breakout(' Unexpectedly I could not find that possible tax deduction. ');

        }


        /**
         *  3) Present a form which is populated with data from the possible_tax_deduction object
         *    and asks for approval for deletion to proceed.
         */

        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'wipeoutapossibletaxdeductiondelete.php';
    }
}