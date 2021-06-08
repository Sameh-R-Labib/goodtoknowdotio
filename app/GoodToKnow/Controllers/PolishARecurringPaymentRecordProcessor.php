<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;
use function GoodToKnow\ControllerHelpers\readable_amount_no_commas;

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


        global $g;


        require CONTROLLERINCLUDES . DIRSEP . 'get_recurring_payment_record.php';


        /**
         * 4) Present a form which is populated with data from the recurring_payment object.
         */


        /**
         * Make it so that if price_point is fiat then price_point has only two decimal places.
         */

        require CONTROLLERHELPERS . DIRSEP . 'readable_amount_no_commas.php';

        $g->recurring_payment_object->amount_paid = readable_amount_no_commas($g->recurring_payment_object->currency, $g->recurring_payment_object->amount_paid);


        /**
         * This type of record has a field called `time`. We are not going to pre-populate a form field with it.
         * Instead we derive an array called $g->time from it and use $g->time to pre-populate the following fields:
         * date, hour, minute, second.
         */

        require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

        $g->time = get_date_h_m_s_from_a_timestamp($g->recurring_payment_object->time);


        $g->html_title = 'Edit the recurring_payment record';


        require VIEWS . DIRSEP . 'polisharecurringpaymentrecordprocessor.php';
    }
}