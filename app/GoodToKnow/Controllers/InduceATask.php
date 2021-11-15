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
         * We need to give default values for the form field
         * variables. The reason we need these variables in the
         * first place is that the form is also used by the redo.
         *
         * The variables are elements of $_SESSION['saved_arr01'].
         */

        $_SESSION['saved_arr01']['label'] = '';
        $_SESSION['saved_arr01']['cycle_type'] = '';
        $_SESSION['saved_arr01']['comment'] = '';
        $_SESSION['saved_arr01']['last']['date'] = '';
        $_SESSION['saved_arr01']['last']['hour'] = '';
        $_SESSION['saved_arr01']['last']['minute'] = '';
        $_SESSION['saved_arr01']['last']['second'] = '';
        $_SESSION['saved_arr01']['next']['date'] = '';
        $_SESSION['saved_arr01']['next']['hour'] = '';
        $_SESSION['saved_arr01']['next']['minute'] = '';
        $_SESSION['saved_arr01']['next']['second'] = '';


        /**
         * This may be redundant, but we need to be sure (better than be sorry.)
         */

        $_SESSION['is_first_attempt'] = true;


        require VIEWS . DIRSEP . 'induceatask.php';
    }
}