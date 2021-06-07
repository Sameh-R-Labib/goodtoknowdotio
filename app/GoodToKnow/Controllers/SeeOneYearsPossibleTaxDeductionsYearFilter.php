<?php

namespace GoodToKnow\Controllers;

class SeeOneYearsPossibleTaxDeductionsYearFilter
{
    function page()
    {
        /**
         * 1) Validate the submitted year_paid.
         * 2) Present the PossibleTaxDeduction(s/plural) in a page whose layout is similar to the Home page.
         */


        global $g;


        require CONTROLLERINCLUDES . DIRSEP . 'get_year_paid_and_its_possibletaxdeductions.php';


        /**
         * Loop through the array and replace attributes with more readable ones.
         */

        foreach ($g->array as $item) {

            $item->comment = nl2br($item->comment, false);

        }

        $g->message .= " Here are one year's tax write-offs. ";

        $g->html_title = "One year\'s tax write-offs.";

        $g->page = 'SeeOneYearsPossibleTaxDeductions';

        $g->show_poof = true;

        require VIEWS . DIRSEP . 'seeoneyearspossibletaxdeductionsyearfilter.php';
    }
}