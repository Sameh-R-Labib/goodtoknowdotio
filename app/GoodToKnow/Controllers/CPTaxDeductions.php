<?php

namespace GoodToKnow\Controllers;

class CPTaxDeductions
{
    function page()
    {
        global $app_state;
        global $show_poof;


        kick_out_loggedoutusers();


        $app_state->page = 'CPTaxDeductions';


        $show_poof = true;


        $app_state->html_title = 'TaxDeductions';


        $app_state->message .= ' Managing tax deductions. ';


        require VIEWS . DIRSEP . 'cptaxdeductions.php';
    }
}