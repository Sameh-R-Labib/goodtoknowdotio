<?php

namespace GoodToKnow\Controllers;

class c_p_recurring_payments
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->page = 'c_p_recurring_payments';


        $g->show_poof = true;


        $g->html_title = 'Recurring Payment';


        $g->message .= ' Manage recurring payments. ';


        require VIEWS . DIRSEP . 'cprecurringpayments.php';
    }
}