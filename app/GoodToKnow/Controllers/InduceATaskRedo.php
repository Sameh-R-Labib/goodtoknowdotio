<?php

namespace GoodToKnow\Controllers;

class InduceATaskRedo
{
    function page()
    {
        /**
         * Q: So, where are we now?
         * A: - We know that there is an anomalous condition for the submitted time fields.
         *    - We have the previously submitted form data, although ...
         *    - The submitted time values are in timestamp form (which needs to be
         *      converted to appear in the form again.)
         *    - We need to inform the user he is being shown the form again because
         *      we are giving him the opportunity to fix the times.
         *    - We need to present the form again.
         *    - The form needs to be populated with the previously submitted data.
         */


        /**
         * The data we have:
         *   $g->saved_arr01['label'], $g->saved_arr01['cycle_type'],
         *   $g->saved_arr01['comment'], $g->saved_arr01['last'],
         *   $g->saved_arr01['next']
         *
         * The data we need:
         *   $g->saved_arr01['label'], $g->saved_arr01['cycle_type'],
         *   $g->saved_arr01['comment'], $g->saved_arr01['last']['date'],
         *   $g->saved_arr01['last']['hour'], $g->saved_arr01['last']['minute'],
         *   $g->saved_arr01['last']['second'], $g->saved_arr01['next']['date'],
         *   $g->saved_arr01['next']['hour'], $g->saved_arr01['next']['minute'],
         *   $g->saved_arr01['next']['second']
         *
         *  The Problem Is:
         *    $g->saved_arr01['last'], and $g->saved_arr01['next']
         *    are timestamps. They need to be arrays having elements for date, hour, minute, and second.
         */
    }
}