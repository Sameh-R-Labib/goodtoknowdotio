<?php

namespace GoodToKnow\Controllers;

class WriteToAdmin
{
    function page()
    {
        global $app_state;
        global $pre_populate;


        kick_out_loggedoutusers();


        $admin_username = ADMINUSERNAME;


        /**
         * Display the editor interface.
         */

        $app_state->html_title = 'Write to Admin';

        $pre_populate = <<<ROI
Dear Admin {$admin_username},

I would like you to add a particular topic to a particular community.

Sincerely,

{$app_state->user_username}
ROI;

        require VIEWS . DIRSEP . 'writetoadmin.php';
    }
}