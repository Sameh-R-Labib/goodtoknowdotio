<?php

namespace GoodToKnow\Controllers;

class CPRecurringPayments
{
    function page()
    {
        global $sessionMessage;
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;
        global $is_guest;

        kick_out_loggedoutusers();

        $page = 'CPRecurringPayments';

        $show_poof = true;

        $html_title = 'Recurring Payments';

        $sessionMessage .= ' Manage recurring payments. ';

        require VIEWS . DIRSEP . 'cprecurringpayments.php';
    }
}