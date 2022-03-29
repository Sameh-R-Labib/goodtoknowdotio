<?php

namespace GoodToKnow\Controllers;

class by_username_message
{
    function page()
    {
        /**
         * Make it possible to message a user if the only thing you know about this user is their username.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Present a form for entering a username.
         */

        $g->html_title = 'Username Message a User';

        require VIEWS . DIRSEP . 'byusernamemessage.php';
    }
}