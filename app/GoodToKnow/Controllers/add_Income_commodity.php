<?php

namespace GoodToKnow\Controllers;

class add_income_commodity
{
    function page()
    {
        /**
         * Add Income Commodity
         * ====================
         *
         * Add Income Commodity makes it convenient to both create a TaxableIncomeEvent
         * and a community record. The user only needs to fill out one form.
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

        $g->saved_arr01['label'] = '';
        $g->saved_arr01['date'] = '';
        $g->saved_arr01['hour'] = '';
        $g->saved_arr01['minute'] = '';
        $g->saved_arr01['second'] = '';
        $g->saved_arr01['timezone'] = $g->timezone; // user's default timezone
        $g->saved_arr01['year'] = '';
        $g->saved_arr01['commodity'] = '';
        $g->saved_arr01['amount'] = '';
        $g->saved_arr01['currency'] = '';
        $g->saved_arr01['price'] = '';
        $g->saved_arr01['comment'] = '';

        // Not Necessary:
        //   Update the session variable
        //   $_SESSION['saved_arr01'] = $g->saved_arr01;


        /**
         * This may be redundant, but we need to be sure (better than be sorry.)
         */

        $_SESSION['is_first_attempt'] = true;


        require VIEWS . DIRSEP . 'addincomecommodity.php';
    }
}