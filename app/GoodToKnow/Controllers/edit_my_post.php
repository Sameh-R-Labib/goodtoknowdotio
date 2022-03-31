<?php

namespace GoodToKnow\Controllers;

class edit_my_post
{
    function page()
    {
        /**
         * This is the first in a series of routes aimed at editing a preexisting user's post.
         */

        /**
         * This route will present a form which asks which topic does the post exist in. Remember
         * first we need to have the user identify the post. So this first step will help.
         */


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_topics_for_a_comm_inside_part.php';


        require VIEWS . DIRSEP . 'editmypost.php';
    }
}