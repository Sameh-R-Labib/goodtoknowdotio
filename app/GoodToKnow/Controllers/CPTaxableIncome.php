<?php

namespace GoodToKnow\Controllers;

class CPTaxableIncome
{
    function page()
    {
        global $app_state;
        global $show_poof;


        kick_out_loggedoutusers();


        $app_state->page = 'CPTaxableIncome';


        $show_poof = true;


        $app_state->html_title = 'Taxable Income';


        $app_state->message .= ' Manage taxable income. ';


        require VIEWS . DIRSEP . 'cptaxableincome.php';
    }
}