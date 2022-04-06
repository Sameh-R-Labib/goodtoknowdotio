<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;
use GoodToKnow\Models\possible_tax_deduction;

class conceive_a_possible_tax_deduction_processor
{
    function page()
    {
        /**
         * Create a database record in the possible_tax_deduction table using the submitted possible_tax_deduction data.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $label = standard_form_field_prep('label', 3, 264);

        $year_paid = integer_form_field_prep('year_paid', 1992, 65535);

        // For viewing the records we need this
        $_SESSION['saved_int02'] = (int)$year_paid;

        $comment = standard_form_field_prep('comment', 0, 1800);


        /**
         * Use the submitted data to add a record to the database.
         */

        get_db();

        $array_record = ['user_id' => $g->user_id, 'label' => $label, 'year_paid' => $year_paid, 'comment' => $comment];


        // In memory object.

        $object = possible_tax_deduction::array_to_object($array_record);

        $result = $object->save();

        if (!$result) {

            breakout(' The object\'s save method returned false. ');

        }

        if (!empty($g->message)) {

            breakout(' The object\'s save method did not return false but it did send
            back a message. Therefore, it most likely did not create a new record. ');

        }


        /**
         * Wrap it up.
         */

        $g->message .= ' Your new possible tax deduction was created 👍🏽 ';


        /**
         * We want to reassure the user that the tax deduction record has been saved.
         * So, we are going to hook into the "1 Year's Possible Tax Deductions" feature.
         */

        redirect_to("/ax1/see_one_years_possible_tax_deductions_create_edit/page");

    }
}