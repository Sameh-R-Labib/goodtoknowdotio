<?php

namespace GoodToKnow\Controllers;

class InitializeABitcoinRecord
{
    function page()
    {
        /**
         * F.Y.I.: When we started coding this feature we assumed the only
         * Commodity was Bitcoin. We should replace the word Bitcoin with
         * the word Commodity in the class and file names of this feature,
         * but we've decided not to do so.
         *
         * This feature enables a user to create a database record in the
         * Commodity table.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Create a New Commodity Record';


        /**
         * Because of the concept of redo we need to
         * have a **generic** way of injecting values into the form.
         * That is why you see the code below.
         */

        $g->saved_arr01['address'] = '';
        $g->saved_arr01['commodity'] = '';
        $g->saved_arr01['initial_balance'] = '';
        $g->saved_arr01['current_balance'] = '';
        $g->saved_arr01['currency'] = '';
        $g->saved_arr01['price_point'] = '';
        $g->saved_arr01['comment'] = '';
        $g->saved_arr01['date'] = '';
        $g->saved_arr01['hour'] = '';
        $g->saved_arr01['minute'] = '';
        $g->saved_arr01['second'] = '';
        $g->saved_arr01['timezone'] = $g->timezone; // user's default timezone

        // Not Necessary:
        //   Update the session variable
        //   $_SESSION['saved_arr01'] = $g->saved_arr01;


        /**
         * This may be redundant, but we need to be sure (better than be sorry.)
         */

        $_SESSION['is_first_attempt'] = true;


        require VIEWS . DIRSEP . 'initializeabitcoinrecord.php';
    }
}