<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;
use GoodToKnow\Models\possible_tax_deduction;

class alter_a_possible_tax_deduction_update
{
    function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted form data.
         *      (and apply htmlspecialchars)
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         * 5) Report success.
         */

        global $g;
        // $g->saved_int01 record id

        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * This function will:
         * 1) Validate the submitted form data.
         *      (and apply htmlspecialchars)
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $edited_label = standard_form_field_prep('label', 3, 264);

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $edited_year_paid = integer_form_field_prep('year_paid', 1992, 65535);

        // For viewing the records we need this
        $_SESSION['saved_int02'] = $edited_year_paid;

        $edited_comment = standard_form_field_prep('comment', 0, 1800);


        /**
         * 2) Retrieve the existing record from the database.
         */

        get_db();

        $g->object = possible_tax_deduction::find_by_id($g->saved_int01);

        if (!$g->object) {

            breakout(' Unexpectedly I could not find that record. ');

        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $g->object->label = $edited_label;
        $g->object->year_paid = $edited_year_paid;
        $g->object->comment = $edited_comment;


        /**
         * 4) Update/save the updated record in the database.
         */

        $result = $g->object->save();

        if ($result === false) {

            breakout(' I aborted because I failed at saving the updated object (most likely because you did not make any
            changes to it.) ');

        }


        /**
         * 5) Report success.
         */

        $g->message .= " I've updated <b>{$g->object->label}</b>. ";


        /**
         * We want to reassure the user that the tax deduction record has been updated.
         * So, we are going to hook into the "1 Year's Possible Tax Deductions" feature.
         */

        redirect_to("/ax1/see_one_years_possible_tax_deductions_create_edit/page");

    }
}