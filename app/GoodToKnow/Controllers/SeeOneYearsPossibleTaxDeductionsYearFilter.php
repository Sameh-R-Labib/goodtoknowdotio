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


        global $gtk;
        global $show_poof;
        global $array;


        require CONTROLLERINCLUDES . DIRSEP . 'get_year_paid_and_its_possibletaxdeductions.php';


        /**
         * Loop through the array and replace attributes with more readable ones.
         */

        foreach ($array as $item) {

            $item->comment = nl2br($item->comment, false);

        }

        $gtk->message .= " Here are one year's tax write-offs. ";

        $gtk->html_title = "One year\'s tax write-offs.";

        $gtk->page = 'SeeOneYearsPossibleTaxDeductions';

        $show_poof = true;

        require VIEWS . DIRSEP . 'seeoneyearspossibletaxdeductionsyearfilter.php';
    }
}