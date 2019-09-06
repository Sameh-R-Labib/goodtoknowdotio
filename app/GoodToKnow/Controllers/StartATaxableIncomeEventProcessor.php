<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TaxableIncomeEvent;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class StartATaxableIncomeEventProcessor
{
    function page()
    {
        /**
         * Create a database record in the taxable_income_event table using the submitted taxable_income_event
         * label, year_received and time. The remaining field values will be set to default values.
         *
         * $_POST['label'] $_POST['year_received'] $_POST['time']
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
         * Get year_received
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $year_received = integer_form_field_prep('year_received', 1992, 65535);


        /**
         * Get time
         */

        $time = integer_form_field_prep('time', 0, PHP_INT_MAX);

        if ($time === 0) $time = 1560190617;


        /**
         * Create a taxable_income_event array for the record.
         */

        $array_record = ['user_id' => $user_id, 'time' => $time, 'year_received' => $year_received, 'currency' => '',
            'amount' => 0, 'label' => $label, 'comment' => ''];


        /**
         * Make the array into an in memory taxable_income_event object for the record.
         */

        $object = TaxableIncomeEvent::array_to_object($array_record);


        /**
         * Save the object.
         */

        $db = get_db();

        $result = $object->save($db, $sessionMessage);

        if (!$result) {

            breakout(' The save method for TaxableIncomeEvent returned false. ');

        }

        if (!empty($sessionMessage)) {

            breakout(' The save method for TaxableIncomeEvent did not return false but it did send
            back a message. Therefore, it probably did not create the TaxableIncomeEvent record. ');

        }


        /**
         * Wrap it up.
         */

        breakout(' A Taxable Income Event was created 👍🏿. ');
    }
}