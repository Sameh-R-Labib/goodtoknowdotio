<?php

namespace GoodToKnow\Controllers;

class AlterAPossibleTaxDeductionYearFilter
{
    function page()
    {
        global $html_title;


        require CONTROLLERINCLUDES . DIRSEP . 'get_year_paid_and_its_possibletaxdeductions.php';


        $html_title = 'Which possible_tax_deduction?';


        require VIEWS . DIRSEP . 'alterapossibletaxdeductionyearfilter.php';
    }
}