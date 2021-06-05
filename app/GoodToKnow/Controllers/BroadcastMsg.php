<?php

namespace GoodToKnow\Controllers;

class BroadcastMsg
{
    function page()
    {
        global $gtk;


        kick_out_nonadmins();


        /**
         * Display the editor interface.
         */

        $gtk->html_title = 'Broadcast a Message';

        $gtk->pre_populate = <<<ROI
Dear Users,

[Broadcast to all]

Sincerely,

Admin {$gtk->user_username}
ROI;

        require VIEWS . DIRSEP . 'broadcastmsg.php';
    }
}