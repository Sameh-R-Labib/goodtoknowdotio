<?php

namespace GoodToKnow\Controllers;

class CPTaxDeductions
{
    function page()
    {
        global $gtk;


        kick_out_loggedoutusers();


        $gtk->page = 'CPTaxDeductions';


        $gtk->show_poof = true;


        $gtk->html_title = 'TaxDeductions';


        $gtk->message .= ' Managing tax deductions. ';


        require VIEWS . DIRSEP . 'cptaxdeductions.php';
    }
}