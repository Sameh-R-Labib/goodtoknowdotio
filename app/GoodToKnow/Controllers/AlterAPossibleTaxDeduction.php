<?php


namespace GoodToKnow\Controllers;


class AlterAPossibleTaxDeduction
{
    function page()
    {
        /**
         * This page is going to present a text box for entering a year_paid value to be used
         * to narrow down the choices for which possible_tax_deduction to edit.
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Which year paid?';


        require VIEWS . DIRSEP . 'alterapossibletaxdeduction.php';
    }
}