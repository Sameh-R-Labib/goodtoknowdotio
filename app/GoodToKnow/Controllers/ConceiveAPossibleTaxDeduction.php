<?php

namespace GoodToKnow\Controllers;

class ConceiveAPossibleTaxDeduction
{
    function page()
    {
        /**
         * This feature enables any user to create a database record in the
         * possible_tax_deduction table.
         *
         * The process will ask the user to ONLY supply a possible_tax_deduction
         * label + year_paid . And the remaining field values
         * will be supplied by the editor for this type of record.
         */

        /**
         * This here script simply presents a form for the user to supply the possible_tax_deduction
         * label + year_paid for the "to be created" possible_tax_deduction record.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg_or_if_there_is_error_msg();


        $g->html_title = 'Create a New Possible Tax Deduction';


        require VIEWS . DIRSEP . 'conceiveapossibletaxdeduction.php';
    }
}