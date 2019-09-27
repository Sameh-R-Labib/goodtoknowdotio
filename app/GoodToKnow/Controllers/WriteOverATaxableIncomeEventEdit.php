<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;

class WriteOverATaxableIncomeEventEdit
{
    function page()
    {
        /**
         * 1) Store the submitted taxable_income_event id in the session.
         * 2) Retrieve the taxable_income_event object with that id from the database.
         * 3) Make sure the object belongs to the user.
         * 4) Present a form which is populated with data from the taxable_income_event object.
         */


        /** @var $object */

        require CONTROLLERINCLUDES . DIRSEP . 'get_the_taxableincomeevent.php';


        /**
         * 4) Present a form which is populated with data from the taxable_income_event object.
         */


        /**
         * This type of record has a field called `time`. We are not going to pre-populate a form field with it.
         * Instead we derive an array called $time from it and use $time to pr-populate the following fields:
         * date, hour, minute, second.
         */

        require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

        $time = get_date_h_m_s_from_a_timestamp($object->time);

        $html_title = 'Edit the taxable income event\'s record';

        require VIEWS . DIRSEP . 'writeoverataxableincomeeventedit.php';
    }
}