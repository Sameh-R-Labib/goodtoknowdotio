<?php

namespace GoodToKnow\Controllers;

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


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_taxableincomeevent.php';


        /**
         * 4) Present a form which is populated with data from the taxable_income_event object.
         */

        $html_title = 'Edit the taxable income event\'s record';

        require VIEWS . DIRSEP . 'writeoverataxableincomeeventedit.php';
    }
}