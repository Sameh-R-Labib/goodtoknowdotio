<?php

namespace GoodToKnow\Controllers;

class conceive_a_possible_tax_deduction
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


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Create a New Possible Tax Deduction';


        /**
         * Because of the concept of redo we need to
         * have a **generic** way of injecting values into the form.
         * That is why you see the code below.
         */

        $g->saved_arr01['label'] = '';
        $g->saved_arr01['year_paid'] = '';
        $g->saved_arr01['comment'] = '';

        // Not Necessary:
        //   Update the session variable
        //   $_SESSION['saved_arr01'] = $g->saved_arr01;


        /**
         * This may be redundant, but we need to be sure (better than be sorry.)
         */

        $_SESSION['is_first_attempt'] = true;


        $g->action = '/ax1/conceive_a_possible_tax_deduction_processor/page';
        $g->heading_one = 'Create a Possible Tax Deduction';
        require VIEWSDUPLICATESINCLUDES . DIRSEP . 'possible_tax_deduction_form.php';
    }
}