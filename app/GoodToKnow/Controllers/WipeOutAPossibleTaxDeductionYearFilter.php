<?php

namespace GoodToKnow\Controllers;

class WipeOutAPossibleTaxDeductionYearFilter
{
    function page()
    {
        global $app_state;


        require CONTROLLERINCLUDES . DIRSEP . 'get_year_paid_and_its_possibletaxdeductions.php';


        /**
         * Present the view.
         */

        $app_state->html_title = 'Which possible_tax_deduction record?';

        require VIEWS . DIRSEP . 'wipeoutapossibletaxdeductionyearfilter.php';
    }
}