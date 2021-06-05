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

        global $gtk;


        kick_out_loggedoutusers();


        $gtk->html_title = 'Which year paid?';


        require VIEWS . DIRSEP . 'alterapossibletaxdeduction.php';
    }
}