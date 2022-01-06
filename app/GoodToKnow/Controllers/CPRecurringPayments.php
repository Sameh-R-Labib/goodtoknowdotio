<?php

namespace GoodToKnow\Controllers;

class CPRecurringPayments
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->page = 'CPRecurringPayments';


        $g->show_poof = true;


        $g->html_title = 'Recurring Payment';


        $g->message .= ' Manage recurring payments. ';


        require VIEWS . DIRSEP . 'cprecurringpayments.php';
    }
}