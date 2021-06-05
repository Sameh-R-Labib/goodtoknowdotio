<?php

namespace GoodToKnow\Controllers;

class CPRecurringPayments
{
    function page()
    {
        global $gtk;
        global $show_poof;


        kick_out_loggedoutusers();


        $gtk->page = 'CPRecurringPayments';


        $show_poof = true;


        $gtk->html_title = 'Recurring Payments';


        $gtk->message .= ' Manage recurring payments. ';


        require VIEWS . DIRSEP . 'cprecurringpayments.php';
    }
}