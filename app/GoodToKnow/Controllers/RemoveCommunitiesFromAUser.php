<?php

namespace GoodToKnow\Controllers;

class RemoveCommunitiesFromAUser
{
    function page()
    {
        global $g;


        kick_out_nonadmins();


        /**
         * Collect the username.
         */

        $g->html_title = 'Remove Communities from A User';

        require VIEWS . DIRSEP . 'removecommunitiesfromauser.php';
    }
}