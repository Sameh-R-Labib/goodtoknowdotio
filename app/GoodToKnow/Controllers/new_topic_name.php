<?php

namespace GoodToKnow\Controllers;

class new_topic_name
{
    function page()
    {
        /**
         * The goal is to present a form for entering the title of the new topic.
         */


        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        $g->html_title = "What's its name?";

        require VIEWS . DIRSEP . 'newtopicname.php';
    }
}