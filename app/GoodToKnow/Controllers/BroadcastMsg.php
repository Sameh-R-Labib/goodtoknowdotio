<?php

namespace GoodToKnow\Controllers;

class BroadcastMsg
{
    function page()
    {
        global $html_title;
        global $pre_populate;
        global $user_username;


        kick_out_nonadmins();


        /**
         * Display the editor interface.
         */

        $html_title = 'Broadcast a Message';

        $pre_populate = <<<ROI
Dear Users,

[Broadcast to all]

Sincerely,

Admin {$user_username}
ROI;

        require VIEWS . DIRSEP . 'broadcastmsg.php';
    }
}