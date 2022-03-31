<?php

namespace GoodToKnow\Controllers;

class edit_post_title
{
    function page()
    {
        /**
         * This is the first in a series of routes aimed at editing the title
         * and extended title of preexisting post belonging to the user.
         *
         * This route will present a form which asks which topic does the post exist in.
         */


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_topics_for_a_comm_inside_part.php';


        require VIEWS . DIRSEP . 'editposttitle.php';

    }

}