<?php

namespace GoodToKnow\Controllers;

class c_p_taxable_income
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $g->page = 'c_p_taxable_income';


        $g->show_poof = true;


        $g->html_title = 'Taxable Income Event';


        $g->message .= ' A feature for recording your taxable income events. ';


        require VIEWS . DIRSEP . 'cptaxableincome.php';
    }
}