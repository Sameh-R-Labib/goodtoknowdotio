<?php

namespace GoodToKnow\Controllers;

class AlterAPossibleTaxDeductionEdit
{
    function page()
    {
        global $g;

        /**
         * 1) Store the submitted possible_tax_deduction id in the session.
         * 2) Retrieve the possible_tax_deduction object with that id from the database.
         * 3) Make sure the object belongs to this user.
         * 4) Present a form which is populated with data from the possible_tax_deduction object.
         */


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        $g->html_title = 'Edit the possible_tax_deduction record';


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_possibletaxdeduction.php';


        /**
         * I know this feature does not do a redo. However, ...
         *
         * Because of the concept of redo we need to
         * have a **generic** way of injecting values into the form.
         * That is why you see the code below.
         */

        $g->saved_arr01['label'] = $g->object->label;
        $g->saved_arr01['year_paid'] = $g->object->year_paid;
        $g->saved_arr01['comment'] = $g->object->comment;

        // Not Necessary:
        //   Update the session variable
        //   $_SESSION['saved_arr01'] = $g->saved_arr01;


        /**
         * This may be redundant, but we need to be sure (better than be sorry.)
         */

        $_SESSION['is_first_attempt'] = true;


        $g->action = '/ax1/AlterAPossibleTaxDeductionUpdate/page';
        $g->heading_one = 'Edit a Possible Tax Deduction';
        require VIEWSDUPLICATESINCLUDES . DIRSEP . 'possible_tax_deduction_form.php';
    }
}