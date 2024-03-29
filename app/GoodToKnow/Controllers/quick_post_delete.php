<?php

namespace GoodToKnow\Controllers;

class quick_post_delete
{
    function page()
    {
        /**
         * This is the first in a series of routes aimed at deleting a preexisting author's
         * post (where the logged-in user is Admin.)
         */

        /**
         * This route will present a form which asks which topic does the post exist in. Remember
         * first we need to have Admin identify the post. So this first step will help.
         */


        kick_out_nonadmins();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_topics_for_a_comm_inside_part.php';


        require VIEWS . DIRSEP . 'quickpostdelete.php';
    }
}