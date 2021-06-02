<?php

namespace GoodToKnow\Controllers;

class CPTaxDeductions
{
    function page()
    {
        global $app_state;
        global $page;
        global $show_poof;
        global $html_title;


        kick_out_loggedoutusers();


        $page = 'CPTaxDeductions';


        $show_poof = true;


        $html_title = 'TaxDeductions';


        $app_state->message .= ' Managing tax deductions. ';


        require VIEWS . DIRSEP . 'cptaxdeductions.php';
    }
}