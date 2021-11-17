<?php

namespace GoodToKnow\Controllers;

class WipeOutAPossibleTaxDeduction
{
    function page()
    {
        /**
         * Ultimately, this is about deleting a PossibleTaxDeduction.
         *
         * This page is going to present a text box
         * for entering a year_paid value to be used
         * to narrow down the choices for which
         * possible_tax_deduction to delete.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Which year_paid for filtering your tax deduction choices?';


        require VIEWS . DIRSEP . 'wipeoutapossibletaxdeduction.php';
    }
}