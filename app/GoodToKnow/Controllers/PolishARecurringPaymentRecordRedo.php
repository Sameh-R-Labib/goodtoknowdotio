<?php

namespace GoodToKnow\Controllers;

class PolishARecurringPaymentRecordRedo
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Tell the user he is seeing the form a 2nd time.
         */

        $g->message .= ' <b>We are giving you one chance to fix the time value which we think is wrong.</b> ';


        $g->html_title = 'One chance to redo';


        $g->action = '/ax1/PolishARecurringPaymentRecordSubmit/page';
        $g->heading_one = $g->saved_arr01['label'];
        require VIEWSDUPLICATESINCLUDES . DIRSEP . 'recurring_payment_record_form.php';
    }
}