<?php

namespace GoodToKnow\Controllers;

class remove_communities_from_a_user
{
    function page()
    {
        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        /**
         * Collect the username.
         */

        $g->html_title = 'Remove Communities from A User';

        require VIEWS . DIRSEP . 'removecommunitiesfromauser.php';
    }
}