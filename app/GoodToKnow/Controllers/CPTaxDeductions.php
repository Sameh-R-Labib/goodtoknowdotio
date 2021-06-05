<?php

namespace GoodToKnow\Controllers;

class CPTaxDeductions
{
    function page()
    {
        global $gtk;
        global $show_poof;


        kick_out_loggedoutusers();


        $gtk->page = 'CPTaxDeductions';


        $show_poof = true;


        $gtk->html_title = 'TaxDeductions';


        $gtk->message .= ' Managing tax deductions. ';


        require VIEWS . DIRSEP . 'cptaxdeductions.php';
    }
}