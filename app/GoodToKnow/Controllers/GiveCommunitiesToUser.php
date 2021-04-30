<?php

namespace GoodToKnow\Controllers;

class GiveCommunitiesToUser
{
    function page()
    {
        global $html_title;


        kick_out_nonadmins();


        /**
         * Collect the username.
         */

        $html_title = 'Give Communities to User';

        require VIEWS . DIRSEP . 'givecommunitiestouser.php';
    }
}