<?php

namespace GoodToKnow\Controllers;

class StartATaxableIncomeEvent
{
    function page()
    {
        /**
         * This feature enables any user to create a database record in the
         * taxable_income_event table. The process will ask the user to ONLY
         * supply a taxable_income_event label + year_received + time . And
         * the remaining field values will be supplied by the editor for this
         * type of record.
         */

        /**
         * This here script simply presents a form for the user to supply the taxable_income_event
         * label + year_received + time for the "to be created" taxable_income_event record.
         */

        global $sessionMessage;

        kick_out_loggedoutusers();

        $html_title = 'Create a Taxable Income Event';

        require VIEWS . DIRSEP . 'startataxableincomeevent.php';
    }
}