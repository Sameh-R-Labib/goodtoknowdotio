<?php

namespace GoodToKnow\Controllers;

class c_p_tax_deductions
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'c_p_tax_deductions';


        $g->show_poof = true;


        $g->html_title = 'TaxDeductions';


        $g->message .= ' Managing tax deductions. ';


        require VIEWS . DIRSEP . 'cptaxdeductions.php';
    }
}