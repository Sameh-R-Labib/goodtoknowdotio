<?php

namespace GoodToKnow\Controllers;

class induce_a_task
{
    function page()
    {
        /**
         * Create a task record based on a label for it.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Create a New Task';


        /**
         * We need to assign default values for the form field
         * variables. The reason we need these particular variable names
         * is that the form is also used by the redo.
         *
         * All the form's variables are elements of $g->saved_arr01.
         */

        $g->saved_arr01['label'] = '';
        $g->saved_arr01['cycle_type'] = '';
        $g->saved_arr01['comment'] = '';
        $g->saved_arr01['last_date'] = '';
        $g->saved_arr01['last_hour'] = '';
        $g->saved_arr01['last_minute'] = '';
        $g->saved_arr01['last_second'] = '';
        $g->saved_arr01['next_date'] = '';
        $g->saved_arr01['next_hour'] = '';
        $g->saved_arr01['next_minute'] = '';
        $g->saved_arr01['next_second'] = '';
        $g->saved_arr01['timezone'] = $g->timezone; // user's default timezone

        // Not Necessary:
        //   Update the session variable
        //   $_SESSION['saved_arr01'] = $g->saved_arr01;


        /**
         * This may be redundant, but we need to be sure (better than be sorry.)
         */

        $_SESSION['is_first_attempt'] = true;


        $g->action = '/ax1/induce_a_task_create/page';
        $g->heading_one = 'Create a Task';
        require VIEWSDUPLICATESINCLUDES . DIRSEP . 'task_form.php';
    }
}