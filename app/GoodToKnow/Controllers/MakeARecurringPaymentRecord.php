<?php

namespace GoodToKnow\Controllers;

class MakeARecurringPaymentRecord
{
    function page()
    {
        /**
         * This feature enables any user to create a database record in the recurring_payment table.
         * The process will ask the user to ONLY supply a label for the record. The remaining field values
         * will be supplied by a (not included) editor for the record.
         */

        /**
         * This here script simply presents a form for the user to supply the label for the "to be created"
         * recurring_payment record.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Create a New Recurring Payment Record';


        require VIEWS . DIRSEP . 'makearecurringpaymentrecord.php';
    }
}