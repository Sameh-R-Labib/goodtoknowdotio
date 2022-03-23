<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Topic;

class TopicDescriptionEditorForm
{
    function page()
    {
        /**
         * Present a (pre-filled with current description) form for editing.
         */


        global $g;
        // $g->saved_int01 community id


        // $g->saved_str01 is the topic name


        kick_out_nonadmins_or_if_there_is_error_msg();


        get_db();

        $g->topic_object = Topic::find_by_id($g->saved_int01);

        if (!$g->topic_object) {

            breakout(' I was unexpectedly unable to retrieve target topic\'s object. ');

        }


        $g->html_title = "Topic's Description Editor";


        require VIEWS . DIRSEP . 'topicdescriptioneditorform.php';
    }
}