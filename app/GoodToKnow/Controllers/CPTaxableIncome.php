<?php

namespace GoodToKnow\Controllers;

class CPTaxableIncome
{
    function page()
    {
        global $app_state;
        global $show_poof;
        global $html_title;


        kick_out_loggedoutusers();


        $app_state->page = 'CPTaxableIncome';


        $show_poof = true;


        $html_title = 'Taxable Income';


        $app_state->message .= ' Manage taxable income. ';


        require VIEWS . DIRSEP . 'cptaxableincome.php';
    }
}