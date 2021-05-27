<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Topic;

class TopicDescriptionEditorForm
{
    function page()
    {
        /**
         * Goals for this function:
         *  1) Retrieve the Topic object for the topic whose description the admin wants to edit.
         *  2) Present a (pre-filled with current description) form for editing.
         */

        global $db;
        global $sessionMessage;
        global $saved_int01; // community id
        global $html_title;
        global $topic_object;


        // $saved_str01 is the topic name


        kick_out_nonadmins();


        $db = get_db();

        $topic_object = Topic::find_by_id($saved_int01);

        if (!$topic_object) {

            breakout(' I was unexpectedly unable to retrieve target topic\'s object. ');

        }


        $html_title = "Topic's Description Editor";


        require VIEWS . DIRSEP . 'topicdescriptioneditorform.php';
    }
}