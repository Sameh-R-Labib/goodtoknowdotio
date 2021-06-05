<?php

namespace GoodToKnow\Controllers;

class TransferPostOwnershipChoosePost
{
    function page()
    {
        /**
         * The goal is to present a form with radio buttons for admin to choose the post to transfer ownership of.
         * We are ONLY presenting posts found in the topic which was already selected. If we can't find any posts then
         * we'll store a session message and redirect back home.
         *
         * For each post we will show the complete name of the post along with the username of its author.
         */


        global $gtk;


        require CONTROLLERINCLUDES . DIRSEP . 'get_posts_along_with_their_authors.php';


        $gtk->html_title = 'Which post to transfer ownership of?';


        require VIEWS . DIRSEP . 'transferpostownershipchoosepost.php';
    }
}