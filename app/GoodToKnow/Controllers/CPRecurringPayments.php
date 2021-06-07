<?php

namespace GoodToKnow\Controllers;

class CPRecurringPayments
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'CPRecurringPayments';


        $g->show_poof = true;


        $g->html_title = 'Recurring Payments';


        $g->message .= ' Manage recurring payments. ';


        require VIEWS . DIRSEP . 'cprecurringpayments.php';
    }
}