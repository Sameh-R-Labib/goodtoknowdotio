<?php

namespace GoodToKnow\Controllers;

class CPTaxableIncome
{
    function page()
    {
        global $gtk;
        global $show_poof;


        kick_out_loggedoutusers();


        $gtk->page = 'CPTaxableIncome';


        $show_poof = true;


        $gtk->html_title = 'Taxable Income';


        $gtk->message .= ' Manage taxable income. ';


        require VIEWS . DIRSEP . 'cptaxableincome.php';
    }
}