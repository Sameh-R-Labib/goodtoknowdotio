<?php

namespace GoodToKnow\Controllers;

class WipeOutAPossibleTaxDeductionYearFilter
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_year_paid_and_its_possibletaxdeductions.php';


        /**
         * Present the view.
         */

        $g->html_title = 'Which possible_tax_deduction record?';

        require VIEWS . DIRSEP . 'wipeoutapossibletaxdeductionyearfilter.php';
    }
}