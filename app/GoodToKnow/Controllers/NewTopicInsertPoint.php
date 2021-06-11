<?php

namespace GoodToKnow\Controllers;

class NewTopicInsertPoint
{
    function page()
    {
        /**
         * The goal is to present a form for specifying the location for inserting the new topic.
         *
         * The user answers two questions:
         *  1) Before or After?
         *  2) Which topic?
         *
         * Note: Here it is assumed there is at least one topic in the community.
         * Otherwise, this route will have had been skipped.
         */


        global $g;


        kick_out_nonadmins();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'admin_get_special_topic_array.php';


        $g->html_title = 'Where will the new topic go?';


        require VIEWS . DIRSEP . 'newtopicinsertpoint.php';
    }
}