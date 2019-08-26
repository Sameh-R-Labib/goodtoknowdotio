<?php

namespace GoodToKnow\Controllers;

class NewTopicName
{
    function page()
    {
        /**
         * The goal is to present a form for entering the title of the new topic.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        kick_out_nonadmins();

        $html_title = "What's its name?";

        require VIEWS . DIRSEP . 'newtopicname.php';
    }
}