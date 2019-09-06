<?php

namespace GoodToKnow\Controllers;

class GiveCommunitiesToUser
{
    function page()
    {
        global $sessionMessage;

        kick_out_nonadmins();


        /**
         * Collect the username.
         */

        $html_title = 'Give Communities to User';

        require VIEWS . DIRSEP . 'givecommunitiestouser.php';
    }
}