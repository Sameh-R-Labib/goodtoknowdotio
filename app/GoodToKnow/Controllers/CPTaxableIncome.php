<?php

namespace GoodToKnow\Controllers;

class CPTaxableIncome
{
    function page()
    {
        global $sessionMessage;
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