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


        kick_out_loggedoutusers();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_year_paid_and_its_possibletaxdeductions.php';


        /**
         * Loop through the array and replace attributes with more readable ones.
         */

        foreach ($g->array as $item) {

            $item->comment = nl2br($item->comment, false);

        }

        $g->html_title = "$g->year_paid's possible tax deductions.";

        $g->page = 'see_one_years_possible_tax_deductions';

        $g->show_poof = true;


        /**
         * This is similar to doing a breakout but there is no redirect,
         * and it does not present the home page itself.
         */

        $g->message .= " Here are <b>$g->year_paid</b>'s possible tax deductions. ";
        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'seeoneyearspossibletaxdeductionsyearfilter.php';
    }
}