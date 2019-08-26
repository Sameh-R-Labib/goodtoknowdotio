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

        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $saved_str01; // topic name
        global $saved_int01; // community id

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            breakout('');
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }

        $topic_object = Topic::find_by_id($db, $sessionMessage, $saved_int01);

        if (!$topic_object) {
            breakout(' I was unexpectedly unable to retrieve target topic\'s object. ');
        }

        $html_title = "Topic's Description Editor";

        require VIEWS . DIRSEP . 'topicdescriptioneditorform.php';
    }
}