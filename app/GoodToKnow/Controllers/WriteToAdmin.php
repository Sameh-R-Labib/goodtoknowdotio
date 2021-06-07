<?php

namespace GoodToKnow\Controllers;

class WriteToAdmin
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        $admin_username = ADMINUSERNAME;


        /**
         * Display the editor interface.
         */

        $g->html_title = 'Write to Admin';

        $g->pre_populate = <<<ROI
Dear Admin {$admin_username},

I would like you to add a particular topic to a particular community.

Sincerely,

{$g->user_username}
ROI;

        require VIEWS . DIRSEP . 'writetoadmin.php';
    }
}