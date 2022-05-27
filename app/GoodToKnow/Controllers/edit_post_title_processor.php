<?php

namespace GoodToKnow\Controllers;

class edit_post_title_processor
{
    function page(int $id = 0)
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->id = $id;


        require CONTROLLERINCLUDES . DIRSEP . 'get_and_save_the_topic_id.php';


        redirect_to("/ax1/edit_post_title_choose_post/page");

    }

}