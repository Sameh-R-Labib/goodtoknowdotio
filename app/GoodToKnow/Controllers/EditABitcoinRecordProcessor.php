<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;

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


        /** @var $bitcoin_object */

        require CONTROLLERINCLUDES . DIRSEP . 'get_bitcoin_record_of_user.php';


        /**
         * 4) Present a form which is populated with data from the object.
         *    (except do the bitcoin address should not be changeable.)
         */


        /**
         * This type of record has a field called `time`. We are not going to pre-populate a form field with it.
         * Instead we derive an array called $time from it and use $time to pr-populate the following fields:
         * date, hour, minute, second.
         */

        require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

        $time = get_date_h_m_s_from_a_timestamp($bitcoin_object->time);

        $html_title = 'Edit the bitcoin record';

        require VIEWS . DIRSEP . 'editabitcoinrecordprocessor.php';
    }
}