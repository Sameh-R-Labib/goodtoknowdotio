<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;

class PolishARecurringPaymentRecordProcessor
{
    function page()
    {
        /**
         * 1) Store the submitted recurring_payment record id in the session.
         * 2) Retrieve the recurring_payment object with that id from the database.
         * 3) Make sure this object belongs to the user.
         * 4) Present a form which is populated with data from the recurring_payment object.
         */


        /** @var $recurring_payment_object */

        require CONTROLLERINCLUDES . DIRSEP . 'get_recurring_payment_record.php';


        /**
         * 4) Present a form which is populated with data from the recurring_payment object.
         */


        /**
         * This type of record has a field called `time`. We are not going to pre-populate a form field with it.
         * Instead we derive an array called $time from it and use $time to pre-populate the following fields:
         * date, hour, minute, second.
         */

        require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

        $time = get_date_h_m_s_from_a_timestamp($recurring_payment_object->time);

        $html_title = 'Edit the recurring_payment record';

        require VIEWS . DIRSEP . 'polisharecurringpaymentrecordprocessor.php';
    }
}