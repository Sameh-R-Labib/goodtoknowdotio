<?php

namespace GoodToKnow\Controllers;

class write_to_admin
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


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