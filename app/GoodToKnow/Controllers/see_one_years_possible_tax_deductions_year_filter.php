<?php

namespace GoodToKnow\Controllers;

class see_one_years_possible_tax_deductions_year_filter
{
    function page()
    {
        /**
         * 1) Validate the submitted year_paid.
         * 2) Present the possible_tax_deduction(s/plural) in a page whose layout is similar to the home page.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_year_paid_and_its_possibletaxdeductions.php';


        /**
         * Loop through the array and replace attributes with more readable ones.
         */

        foreach ($g->array as $item) {

            $item->comment = nl2br($item->comment, false);

        }

        $g->message .= " Here are $g->year_paid's possible tax deductions. ";

        $g->html_title = "$g->year_paid's possible tax deductions.";

        $g->page = 'see_one_years_possible_tax_deductions';

        $g->show_poof = true;

        require VIEWS . DIRSEP . 'seeoneyearspossibletaxdeductionsyearfilter.php';
    }
}