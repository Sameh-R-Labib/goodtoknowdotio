<?php

namespace GoodToKnow\Controllers;

class default_time_zone
{
    function page()
    {
        /**
         * Make it possible to change one's own default timezone.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Present a form for entering a PHP time zone.
         */

        $g->html_title = 'Change Default Time Zone';

        require VIEWS . DIRSEP . 'defaulttimezone.php';
    }
}