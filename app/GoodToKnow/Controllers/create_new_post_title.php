<?php

namespace GoodToKnow\Controllers;

class create_new_post_title
{
    function page()
    {
        /**
         * Present a form for entering the two parts which comprise the title of the new post.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'What is the title?';


        require VIEWS . DIRSEP . 'createnewposttitle.php';
    }
}