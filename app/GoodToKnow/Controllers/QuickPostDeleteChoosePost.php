<?php

namespace GoodToKnow\Controllers;

class QuickPostDeleteChoosePost
{
    function page()
    {
        /**
         * The goal is to present a form with radio buttons for admin to choose the post to delete. We are ONLY
         * presenting posts found in the topic which was already selected. If we can't find any posts then we'll
         * store a session message and redirect back home.
         *
         * For each post we will show the complete name of the post along
         * with the username of its author.
         */

        require CONTROLLERINCLUDES . DIRSEP . 'get_posts_along_with_their_authors.php';


        $html_title = 'Which post to delete?';

        require VIEWS . DIRSEP . 'quickpostdeletechoosepost.php';
    }
}