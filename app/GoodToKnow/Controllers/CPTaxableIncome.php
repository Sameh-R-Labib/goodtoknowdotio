<?php

namespace GoodToKnow\Controllers;

class CPTaxableIncome
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg_or_if_there_is_error_msg();


        $g->page = 'CPTaxableIncome';


        $g->show_poof = true;


        $g->html_title = 'Taxable Income';


        $g->message .= ' Manage taxable income. ';


        require VIEWS . DIRSEP . 'cptaxableincome.php';
    }
}