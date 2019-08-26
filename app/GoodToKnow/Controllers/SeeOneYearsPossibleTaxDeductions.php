<?php

namespace GoodToKnow\Controllers;

class SeeOneYearsPossibleTaxDeductions
{
    function page()
    {
        /**
         * This page is going to present a text box for entering a year_paid value to be used
         * so that the subsequent code can display the possible_tax_deduction(s/plural) for that year.
         */

        global $is_logged_in;
        global $sessionMessage;

        kick_out_loggedoutusers();

        $html_title = 'Which year_paid for showing possible_tax_deduction(s/plural)?';

        require VIEWS . DIRSEP . 'seeoneyearspossibletaxdeductions.php';
    }
}