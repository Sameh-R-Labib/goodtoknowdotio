<?php

namespace GoodToKnow\Controllers;

class CPTaxDeductions
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'CPTaxDeductions';


        $g->show_poof = true;


        $g->html_title = 'TaxDeductions';


        $g->message .= ' Managing tax deductions. ';


        require VIEWS . DIRSEP . 'cptaxdeductions.php';
    }
}