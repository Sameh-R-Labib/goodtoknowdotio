<?php

namespace GoodToKnow\Controllers;

class NukeATaxableIncomeEvent
{
    function page()
    {
        /**
         * Ultimately, this is about deleting a TaxableIncomeEvent.
         *
         * This page is going to present a text box for entering a year_received to be used
         * to narrow down the choices for which taxable_income_event to delete.
         */

        global $sessionMessage;

        kick_out_loggedoutusers();

        $html_title = 'Which year_received for filtering your taxable income event choices?';

        require VIEWS . DIRSEP . 'nukeataxableincomeevent.php';
    }
}