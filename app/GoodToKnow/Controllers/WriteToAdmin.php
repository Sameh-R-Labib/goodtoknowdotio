<?php

namespace GoodToKnow\Controllers;

class WriteToAdmin
{
    function page()
    {
        global $sessionMessage;
        global $user_username;
        global $url_of_most_recent_upload;

        kick_out_loggedoutusers();

        $admin_username = ADMINUSERNAME;


        /**
         * Display the editor interface.
         */

        $html_title = 'Write to Admin';

        $pre_populate = <<<ROI
Dear Admin {$admin_username},

I would like you to add a particular topic to a particular community.

Sincerely,

{$user_username}
ROI;

        require VIEWS . DIRSEP . 'writetoadmin.php';
    }
}