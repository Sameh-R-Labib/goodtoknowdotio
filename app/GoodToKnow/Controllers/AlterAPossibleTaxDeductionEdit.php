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


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_possibletaxdeduction.php';


        /**
         * 4) Present a form which is populated with data from the possible_tax_deduction object.
         */

        $g->html_title = 'Edit the possible_tax_deduction record';

        require VIEWS . DIRSEP . 'alterapossibletaxdeductionedit.php';
    }
}