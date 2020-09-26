<?php

namespace GoodToKnow\Controllers;

class WipeOutAPossibleTaxDeductionYearFilter
{
    function page()
    {
        global $html_title;

        require CONTROLLERINCLUDES . DIRSEP . 'get_year_paid_and_its_possibletaxdeductions.php';

        $html_title = 'Which possible_tax_deduction record?';

        require VIEWS . DIRSEP . 'wipeoutapossibletaxdeductionyearfilter.php';
    }
}