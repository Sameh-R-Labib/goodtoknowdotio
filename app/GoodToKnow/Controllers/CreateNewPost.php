<?php

namespace GoodToKnow\Controllers;

class CreateNewPost
{
    function page()
    {
        /**
         * This is the first of a series of routes aimed at creating a new post.
         *
         * The first task is that of presenting a form for getting the user to tell us
         * which topic the post belongs in.
         */


        kick_out_loggedoutusers();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_topics_for_a_comm_inside_part.php';


        require VIEWS . DIRSEP . 'createnewpost.php';
    }
}