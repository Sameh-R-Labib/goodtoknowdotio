<?php

namespace GoodToKnow\Controllers;

class AddIncomeCommodity
{
    function page()
    {
        /**
         * Add Income Commodity
         * ====================
         *
         * Add Income Commodity makes it convenient to both create a TaxableIncomeEvent
         * and a Community record. The user only needs to fill out one form.
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Enter Transfer Data';


        /**
         * We need to assign default values for the form field
         * variables. The reason we need these particular variable names
         * is that the form is also used by the redo.
         *
         * All the form's variables are elements of $g->saved_arr01.
         */
    }
}