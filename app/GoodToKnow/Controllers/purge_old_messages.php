<?php

namespace GoodToKnow\Controllers;

class purge_old_messages
{
    function page()
    {
        /**
         * This is the first in a sequence of routes for deleting the messages which are older
         * than a specified time.
         *
         * This first route will present a form in which the admin will enter the time at
         * which all older messages will be deleted.
         *
         * The time will be entered as a date. The assumption is that all messages
         * sent before the zero hour (12am) will be deleted.
         */


        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        $g->html_title = 'Purge Old Messages';


        require VIEWS . DIRSEP . 'purgeoldmessages.php';
    }
}