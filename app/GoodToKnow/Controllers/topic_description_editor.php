<?php

namespace GoodToKnow\Controllers;

class topic_description_editor
{
    function page()
    {
        /**
         * Present a form which collects the topic's id. The topics presented for the user to choose from are the
         * ones found in the user's current community.
         */


        global $g;


        kick_out_nonadmins();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_special_topic_array.php';


        // Abort if the community doesn't have any topics yet

        if (empty($g->special_topic_array)) {

            breakout(' Aborted because you can not create a post in a community which has no topics. ');

        }


        $g->html_title = "Topic's Description Editor";


        require VIEWS . DIRSEP . 'topicdescriptioneditor.php';
    }
}