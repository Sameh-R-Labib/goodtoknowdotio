<?php

namespace GoodToKnow\Controllers;

class edit_my_post_processor
{
    function page()
    {
        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require CONTROLLERINCLUDES . DIRSEP . 'get_and_save_the_topic_id.php';


        redirect_to("/ax1/edit_my_post_choose_post/page");
    }
}