<?php

namespace GoodToKnow\Controllers;

class AuthorDeletesOwnPostProcessor
{
    function page()
    {
        require CONTROLLERINCLUDES . DIRSEP . 'get_and_save_the_topic_id.php';

        redirect_to("/ax1/AuthorDeletesOwnPostChoosePost/page");
    }
}