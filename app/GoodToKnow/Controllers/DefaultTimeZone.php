<?php

namespace GoodToKnow\Controllers;

class DefaultTimeZone
{
    function page()
    {
        /**
         * Make it possible to change one's own default timezone.
         */

        global $sessionMessage;
        global $html_title;

        kick_out_loggedoutusers();


        /**
         * Present a form for entering a PHP time zone.
         */

        $html_title = 'Change Default Time Zone';

        require VIEWS . DIRSEP . 'defaulttimezone.php';
    }
}