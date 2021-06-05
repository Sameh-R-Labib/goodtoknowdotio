<?php

namespace GoodToKnow\Controllers;

class BroadcastMsg
{
    function page()
    {
        global $app_state;
        global $pre_populate;


        kick_out_nonadmins();


        /**
         * Display the editor interface.
         */

        $app_state->html_title = 'Broadcast a Message';

        $pre_populate = <<<ROI
Dear Users,

[Broadcast to all]

Sincerely,

Admin {$app_state->user_username}
ROI;

        require VIEWS . DIRSEP . 'broadcastmsg.php';
    }
}