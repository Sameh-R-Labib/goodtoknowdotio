<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;
use function GoodToKnow\ControllerHelpers\readable_amount_no_commas;

class EditABitcoinRecordProcessor
{
    function page()
    {
        /**
         * 1) Store the submitted bitcoin record id in the session.
         * 2) Retrieve the object with that id from the database.
         * 3) Verify that this object belongs to the user.
         * 4) Present a form which is populated with data from the object. (except the bitcoin address should not be changeable.)
         */


        global $html_title;
        global $time;
        global $bitcoin_object;


        require CONTROLLERINCLUDES . DIRSEP . 'get_bitcoin_record_of_user.php';


        /**
         * 4) Present a form which is populated with data from the object.
         *    (except do the bitcoin address should not be changeable.)
         */


        /**
         * Make it so that if price_point is fiat then price_point has only two decimal places.
         */

        require CONTROLLERHELPERS . DIRSEP . 'readable_amount_no_commas.php';

        $bitcoin_object->price_point = readable_amount_no_commas($bitcoin_object->currency, $bitcoin_object->price_point);


        /**
         * This type of record has a field called `time`. We are not going to pre-populate a form field with it.
         * Instead we derive an array called $time from it and use $time to pre-populate the following fields:
         * date, hour, minute, second.
         */

        require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

        $time = get_date_h_m_s_from_a_timestamp($bitcoin_object->time);

        $html_title = 'Edit the bitcoin record';

        require VIEWS . DIRSEP . 'editabitcoinrecordprocessor.php';
    }
}