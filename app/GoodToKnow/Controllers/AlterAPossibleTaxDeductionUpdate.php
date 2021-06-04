<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;
use GoodToKnow\Models\PossibleTaxDeduction;

class AlterAPossibleTaxDeductionUpdate
{
    function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted alterapossibletaxdeductionedit.php form data.
         *      (and apply htmlspecialchars)
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         * 5) Report success.
         */

        global $app_state;
        global $db;
        // $app_state->saved_int01 record id
        global $object;

        kick_out_loggedoutusers();


        /**
         * This function will:
         * 1) Validate the submitted alterapossibletaxdeductionedit.php form data.
         *      (and apply htmlspecialchars)
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $edited_label = standard_form_field_prep('label', 3, 264);

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $edited_year_paid = integer_form_field_prep('year_paid', 1992, 65535);

        $edited_comment = standard_form_field_prep('comment', 0, 800);


        /**
         * 2) Retrieve the existing record from the database.
         */

        $db = get_db();

        $object = PossibleTaxDeduction::find_by_id($app_state->saved_int01);

        if (!$object) {

            breakout(' Unexpectedly I could not find that record. ');

        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $object->label = $edited_label;
        $object->year_paid = $edited_year_paid;
        $object->comment = $edited_comment;


        /**
         * 4) Update/save the updated record in the database.
         */

        $result = $object->save();

        if ($result === false) {

            breakout(' I aborted because I failed at saving the updated object. ');

        }


        /**
         * 5) Report success.
         */

        breakout(" I've updated <b>{$object->label}</b>. ");
    }
}