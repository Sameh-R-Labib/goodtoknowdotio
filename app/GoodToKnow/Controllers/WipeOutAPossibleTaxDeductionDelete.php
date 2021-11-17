<?php

namespace GoodToKnow\Controllers;

class WipeOutAPossibleTaxDeductionDelete
{
    function page()
    {
        /**
         * 1) Store the submitted possible_tax_deduction record id in the session.
         * 2) Retrieve the possible_tax_deduction object with that id from the database.
         * 3) Make sure the object belongs to this user.
         * 4) Present a form which is populated with data from the possible_tax_deduction object
         *    and asks for approval for deletion to proceed.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_possibletaxdeduction.php';


        /**
         *  4) Present a form which is populated with data from the possible_tax_deduction object
         *    and asks for approval for deletion to proceed.
         */

        $g->html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'wipeoutapossibletaxdeductiondelete.php';
    }
}