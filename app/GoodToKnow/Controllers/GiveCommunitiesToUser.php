<?php

namespace GoodToKnow\Controllers;

class GiveCommunitiesToUser
{
    function page()
    {
        global $gtk;


        kick_out_nonadmins();


        /**
         * Collect the username.
         */

        $gtk->html_title = 'Give Communities to User';

        require VIEWS . DIRSEP . 'givecommunitiestouser.php';
    }
}