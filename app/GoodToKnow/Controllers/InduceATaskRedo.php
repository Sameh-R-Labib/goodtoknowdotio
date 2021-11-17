<?php

namespace GoodToKnow\Controllers;

class InduceATaskRedo
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
         *   $g->saved_arr01['lastdate'], $g->saved_arr01['nextdate']
         *   $g->saved_arr01['lasthour'], $g->saved_arr01['nexthour']
         *   $g->saved_arr01['lastminute'], $g->saved_arr01['nextminute']
         *   $g->saved_arr01['lastsecond'], $g->saved_arr01['nextsecond']
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


        require VIEWS . DIRSEP . 'induceatask.php';
    }
}