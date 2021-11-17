<?php

namespace GoodToKnow\Controllers;

class BroadcastMsg
{
    function page()
    {
        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        /**
         * Display the editor interface.
         */

        $g->html_title = 'Broadcast a Message';

        $g->pre_populate = <<<ROI
Dear Users,

[Broadcast to all]

Sincerely,

Admin {$g->user_username}
ROI;

        require VIEWS . DIRSEP . 'broadcastmsg.php';
    }
}