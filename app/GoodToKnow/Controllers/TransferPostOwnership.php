<?php

namespace GoodToKnow\Controllers;

class TransferPostOwnership
{
    function page()
    {
        /**
         * This is the first route for transferring ownership of a post.
         *
         * Its goal is to be the first in a bunch of routes to determine which post is to be deleted.
         *
         * It will present radio buttons for choosing which topic the post is in. It will also describe what is being done.
         *
         * As usual the topics presented are the topics in the current community.
         */


        kick_out_nonadmins_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_topics_for_a_comm_inside_part.php';


        require VIEWS . DIRSEP . 'transferpostownership.php';
    }
}