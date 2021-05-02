<?php

namespace GoodToKnow\Controllers;

class QuickPostDelete
{
    function page()
    {
        /**
         * This is the first in a series of routes aimed at deleting a preexisting author's
         * post (where the logged in user is the admin.)
         */

        /**
         * This route will present a form which asks which topic does the post exist in. Remember
         * first we need to have the admin identify the post. So this first step will help.
         */


        kick_out_nonadmins();


        require CONTROLLERINCLUDES . DIRSEP . 'get_topics_for_a_comm_inside_part.php';


        require VIEWS . DIRSEP . 'quickpostdelete.php';
    }
}