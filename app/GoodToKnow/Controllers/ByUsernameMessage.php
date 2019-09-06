<?php

namespace GoodToKnow\Controllers;

class ByUsernameMessage
{
    function page()
    {
        /**
         * The goal of this series of routes is to make it possible to message
         * a user if the only thing you know about this user is their username.
         */

        global $sessionMessage;

        kick_out_loggedoutusers();


        /**
         * Present a form for entering a username.
         */

        $html_title = 'Username Message a User';

        require VIEWS . DIRSEP . 'byusernamemessage.php';
    }
}