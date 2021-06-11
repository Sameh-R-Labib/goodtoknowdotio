<?php

namespace GoodToKnow\Controllers;

class AuthorDeletesOwnPostProcessor
{
    function page()
    {
        kick_out_loggedoutusers();


        require CONTROLLERINCLUDES . DIRSEP . 'get_and_save_the_topic_id.php';


        redirect_to("/ax1/AuthorDeletesOwnPostChoosePost/page");
    }
}