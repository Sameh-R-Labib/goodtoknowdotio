<?php

namespace GoodToKnow\Controllers;

class feature_a_task_redo
{
    function page()
    {
        /**
         * This is similar to induce_a_task::page().
         */

        global $g;

        kick_out_loggedoutusers_or_if_there_is_error_msg();

        $g->message .= ' <b>We are giving you one chance to fix the time values which we think are wrong.</b> ';

        $g->html_title = 'One chance to redo';

        $g->action = '/ax1/feature_a_task_update/page';
        $g->heading_one = 'Edit a Task';
        require VIEWSDUPLICATESINCLUDES . DIRSEP . 'task_form.php';
    }
}