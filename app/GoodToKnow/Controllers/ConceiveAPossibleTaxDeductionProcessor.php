<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;
use GoodToKnow\Models\PossibleTaxDeduction;

class ConceiveAPossibleTaxDeductionProcessor
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

        $comment = standard_form_field_prep('comment', 0, 1800);


        /**
         * Use the submitted data to add a record to the database.
         */

        get_db();

        $array_record = ['user_id' => $g->user_id, 'label' => $label, 'year_paid' => $year_paid, 'comment' => $comment];


        // In memory object.

        $object = PossibleTaxDeduction::array_to_object($array_record);

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

        breakout(' Your new tax write-off has just been created 👍🏽 ');
    }
}