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
         * Create a database record in the possible_tax_deduction table using the submitted possible_tax_deduction
         * label and year_paid. The remaining field values will be set to default values.
         */

        global $sessionMessage;
        global $user_id;

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * Get label
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $label = standard_form_field_prep('label', 3, 264);


        /**
         * Get year_paid
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $year_paid = integer_form_field_prep('year_paid', 1992, 65535);


        /**
         * Use the submitted data to add a record to the database.
         */

        $db = get_db();

        $array_record = ['user_id' => $user_id, 'label' => $label, 'year_paid' => $year_paid, 'comment' => ''];


        // In memory object.

        $object = PossibleTaxDeduction::array_to_object($array_record);

        $result = $object->save($db, $sessionMessage);

        if (!$result) {

            breakout(' The object\'s save method returned false. ');

        }

        if (!empty($sessionMessage)) {

            breakout(' The object\'s save method did not return false but it did send
            back a message. Therefore, it most likely did not create a new record. ');

        }


        /**
         * Wrap it up.
         */

        breakout(' A Possible Tax Deduction was created! ');
    }
}