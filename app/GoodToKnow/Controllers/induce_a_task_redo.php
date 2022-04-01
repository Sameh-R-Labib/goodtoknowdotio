<?php

namespace GoodToKnow\Controllers;

class induce_a_task_redo
{
    function page()
    {
        /**
         * Q: So, where are we now?
         * A: - We know that there is an anomalous condition for the submitted time fields.
         *    - We have the previously submitted form data.
         *    - We need to inform the user he is being shown the form again because
         *      we are giving him the opportunity to fix the times.
         *    - We need to present the form again.
         *    - The form needs to be populated with the previously submitted data.
         */


        /**
         * The data we have:
         *   $g->saved_arr01['label'], $g->saved_arr01['cycle_type'],
         *   $g->saved_arr01['comment'], $g->saved_arr01['timezone'],
         *   $g->saved_arr01['last_date'], $g->saved_arr01['next_date']
         *   $g->saved_arr01['last_hour'], $g->saved_arr01['next_hour']
         *   $g->saved_arr01['last_minute'], $g->saved_arr01['next_minute']
         *   $g->saved_arr01['last_second'], $g->saved_arr01['next_second']
         *
         * This all came from or was derived from the first submit of data by the user.
         * We were diverted here because we perceived an anomaly.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Tell the user he is seeing the form a 2nd time.
         */

        $g->message .= ' <b>We are giving you one chance to fix the time values which we think are wrong.</b> ';


        $g->html_title = 'One chance to redo';


        $g->action = '/ax1/induce_a_task_create/page';
        $g->heading_one = 'Create a Task';
        require VIEWSDUPLICATESINCLUDES . DIRSEP . 'task_form.php';
    }
}