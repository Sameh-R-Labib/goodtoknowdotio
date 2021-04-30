<?php

namespace GoodToKnow\Controllers;

class CPTaxableIncome
{
    function page()
    {
        global $sessionMessage;
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;
        global $is_guest;
        global $page;
        global $show_poof;
        global $html_title;

        kick_out_loggedoutusers();

        $page = 'CPTaxableIncome';

        $show_poof = true;

        $html_title = 'Taxable Income';

        $sessionMessage .= ' Manage taxable income. ';

        require VIEWS . DIRSEP . 'cptaxableincome.php';
    }
}