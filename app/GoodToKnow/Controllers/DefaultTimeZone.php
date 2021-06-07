<?php

namespace GoodToKnow\Controllers;

class DefaultTimeZone
{
    function page()
    {
        /**
         * Make it possible to change one's own default timezone.
         */


        global $g;


        kick_out_loggedoutusers();


        /**
         * Present a form for entering a PHP time zone.
         */

        $g->html_title = 'Change Default Time Zone';

        require VIEWS . DIRSEP . 'defaulttimezone.php';
    }
}