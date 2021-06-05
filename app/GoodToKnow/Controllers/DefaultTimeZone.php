<?php

namespace GoodToKnow\Controllers;

class DefaultTimeZone
{
    function page()
    {
        /**
         * Make it possible to change one's own default timezone.
         */


        global $app_state;


        kick_out_loggedoutusers();


        /**
         * Present a form for entering a PHP time zone.
         */

        $app_state->html_title = 'Change Default Time Zone';

        require VIEWS . DIRSEP . 'defaulttimezone.php';
    }
}