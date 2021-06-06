<?php

namespace GoodToKnow\Controllers;

class CPRecurringPayments
{
    function page()
    {
        global $gtk;


        kick_out_loggedoutusers();


        $gtk->page = 'CPRecurringPayments';


        $gtk->show_poof = true;


        $gtk->html_title = 'Recurring Payments';


        $gtk->message .= ' Manage recurring payments. ';


        require VIEWS . DIRSEP . 'cprecurringpayments.php';
    }
}