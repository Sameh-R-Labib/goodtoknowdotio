<?php

namespace GoodToKnow\Controllers;

class RemoveCommunitiesFromAUser
{
    function page()
    {
        global $gtk;


        kick_out_nonadmins();


        /**
         * Collect the username.
         */

        $gtk->html_title = 'Remove Communities from A User';

        require VIEWS . DIRSEP . 'removecommunitiesfromauser.php';
    }
}