<?php

namespace GoodToKnow\Controllers;

class InduceATask
{
    function page()
    {
        /**
         * Create a task record based on a label for it.
         */

        global $sessionMessage;

        global $timezone;

        kick_out_loggedoutusers();

        $html_title = 'Create a New Task';

        require VIEWS . DIRSEP . 'induceatask.php';
    }
}