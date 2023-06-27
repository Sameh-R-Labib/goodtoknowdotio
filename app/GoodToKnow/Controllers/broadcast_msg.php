<?php

namespace GoodToKnow\Controllers;

class broadcast_msg
{
    function page()
    {
        global $g;


        kick_out_nonadmins();


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