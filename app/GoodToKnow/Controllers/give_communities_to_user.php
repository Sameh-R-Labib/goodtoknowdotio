<?php

namespace GoodToKnow\Controllers;

class give_communities_to_user
{
    function page()
    {
        global $g;


        kick_out_nonadmins();


        /**
         * Collect the username.
         */

        $g->html_title = 'Give Communities to User';

        require VIEWS . DIRSEP . 'givecommunitiestouser.php';
    }
}