<?php

namespace GoodToKnow\Controllers;

class TopicDescriptionEditor
{
    function page()
    {
        /**
         * Present a form which collects the topic's id. The topics presented for the user to choose from are the
         * ones found in the user's current community.
         */


        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'admin_get_special_topic_array.php';


        // Abort if the community doesn't have any topics yet

        if (empty($g->special_topic_array)) {

            breakout(' Aborted because you can\'t create a post in a community which has no topics. ');

        }


        $g->html_title = "Topic's Description Editor";


        require VIEWS . DIRSEP . 'topicdescriptioneditor.php';
    }
}