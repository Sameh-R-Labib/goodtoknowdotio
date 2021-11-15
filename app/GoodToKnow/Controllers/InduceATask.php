<?php

namespace GoodToKnow\Controllers;

class InduceATask
{
    function page()
    {
        /**
         * Create a task record based on a label for it.
         */


        global $g;


        kick_out_loggedoutusers();


        $g->html_title = 'Create a New Task';


        /**
         * We need to assign default values for the form field
         * variables. The reason we need these variables in the
         * first place is that the form is also used by the redo.
         *
         * The variables are elements of $g->saved_arr01.
         */

        $g->saved_arr01['label'] = '';
        $g->saved_arr01['cycle_type'] = '';
        $g->saved_arr01['comment'] = '';
        $g->saved_arr01['last']['date'] = '';
        $g->saved_arr01['last']['hour'] = '';
        $g->saved_arr01['last']['minute'] = '';
        $g->saved_arr01['last']['second'] = '';
        $g->saved_arr01['next']['date'] = '';
        $g->saved_arr01['next']['hour'] = '';
        $g->saved_arr01['next']['minute'] = '';
        $g->saved_arr01['next']['second'] = '';

        // Update the session variable
        $_SESSION['saved_arr01'] = $g->saved_arr01;


        /**
         * This may be redundant, but we need to be sure (better than be sorry.)
         */

        $_SESSION['is_first_attempt'] = true;


        require VIEWS . DIRSEP . 'induceatask.php';
    }
}