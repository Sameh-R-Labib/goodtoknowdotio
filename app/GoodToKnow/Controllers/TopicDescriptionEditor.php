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


        global $gtk;


        require CONTROLLERINCLUDES . DIRSEP . 'admin_get_special_topic_array.php';


        // Abort if the community doesn't have any topics yet

        if (empty($gtk->special_topic_array)) {

            breakout(' Aborted because you can\'t create a post in a community which has no topics. ');

        }


        $gtk->html_title = "Topic's Description Editor";


        require VIEWS . DIRSEP . 'topicdescriptioneditor.php';
    }
}