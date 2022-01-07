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

        /**
         * Because of the concept of redo we need to
         * have a **generic** way of injecting values into the form.
         * That is why you see the code below.
         */

        $g->saved_arr01['label'] = '';
        $g->saved_arr01['currency'] = '';
        $g->saved_arr01['amount_paid'] = '';
        $g->saved_arr01['comment'] = '';
        $g->saved_arr01['date'] = '';
        $g->saved_arr01['hour'] = '';
        $g->saved_arr01['minute'] = '';
        $g->saved_arr01['second'] = '';
        $g->saved_arr01['timezone'] = $g->timezone; // user's default timezone


        // Not Necessary:
        //   Update the session variable
        //   $_SESSION['saved_arr01'] = $g->saved_arr01;


        /**
         * This may be redundant, but we need to be sure (better than be sorry.)
         */

        $_SESSION['is_first_attempt'] = true;


        $g->action = '/ax1/MakeARecurringPaymentRecordProcessor/page';
        $g->heading_one = 'Create Recurring Payment';
        require VIEWSDUPLICATESINCLUDES . DIRSEP . 'recurring_payment_record_form.php';
    }
}