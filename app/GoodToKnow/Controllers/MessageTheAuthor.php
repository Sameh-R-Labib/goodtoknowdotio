<?php

namespace GoodToKnow\Controllers;

class MessageTheAuthor
{
    function page()
    {
        /**
         * This function presents a form where the user can enter a message intended to be received by the author of the
         * post which was most recently displayed on the user's Home page.
         *
         * The textarea input field shall be pre populated with the statement: "Dear {author username},\n\n
         * This is a comment regarding your {post title} post in {topic name} topic of {community name} community.\n\n
         * Sincerely,\n\n {user's username}\n\n"
         *
         * At the top of the form there shall be the statement: "You can use markdown and UTF-8 characters."
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Display the editor interface.
         */

        $g->html_title = 'Message the Author';

        $g->pre_populate = <<<ROI
Dear $g->author_username,

This message is in regards to your "$g->post_name" post in the "$g->topic_name" topic of the
"$g->community_name" community.

Sincerely,

{$g->user_username}


ROI;

        require VIEWS . DIRSEP . 'messagetheauthor.php';
    }
}