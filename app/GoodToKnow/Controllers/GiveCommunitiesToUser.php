<?php

namespace GoodToKnow\Controllers;

class GiveCommunitiesToUser
{
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        kick_out_nonadmins();


        /**
         * Collect the username.
         */

        $html_title = 'Give Communities to User';

        require VIEWS . DIRSEP . 'givecommunitiestouser.php';
    }
}