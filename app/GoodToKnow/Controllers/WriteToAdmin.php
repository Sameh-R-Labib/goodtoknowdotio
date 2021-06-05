<?php

namespace GoodToKnow\Controllers;

class WriteToAdmin
{
    function page()
    {
        global $gtk;


        kick_out_loggedoutusers();


        $admin_username = ADMINUSERNAME;


        /**
         * Display the editor interface.
         */

        $gtk->html_title = 'Write to Admin';

        $gtk->pre_populate = <<<ROI
Dear Admin {$admin_username},

I would like you to add a particular topic to a particular community.

Sincerely,

{$gtk->user_username}
ROI;

        require VIEWS . DIRSEP . 'writetoadmin.php';
    }
}