<?php

namespace GoodToKnow\Controllers;

class ByUsernameMessage
{
    function page()
    {
        /**
         * Make it possible to message a user if the only thing you know about this user is their username.
         */


        global $gtk;


        kick_out_loggedoutusers();


        /**
         * Present a form for entering a username.
         */

        $gtk->html_title = 'Username Message a User';

        require VIEWS . DIRSEP . 'byusernamemessage.php';
    }
}