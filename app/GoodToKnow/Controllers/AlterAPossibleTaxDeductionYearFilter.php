<?php

namespace GoodToKnow\Controllers;

class AlterAPossibleTaxDeductionYearFilter
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_year_paid_and_its_possibletaxdeductions.php';


        $g->html_title = 'Which possible_tax_deduction?';


        require VIEWS . DIRSEP . 'alterapossibletaxdeductionyearfilter.php';
    }
}