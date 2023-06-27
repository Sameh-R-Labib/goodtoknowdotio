<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\topic;

class topic_description_editor_form
{
    function page()
    {
        /**
         * Present a (pre-filled with current description) form for editing.
         */


        global $g;
        // $g->saved_int01 community id


        // $g->saved_str01 is the topic name


        kick_out_nonadmins();


        get_db();

        $g->topic_object = topic::find_by_id($g->saved_int01);

        if (!$g->topic_object) {

            breakout(' I was unexpectedly unable to retrieve target topic\'s object. ');

        }


        $g->html_title = "Topic's Description Editor";


        require VIEWS . DIRSEP . 'topicdescriptioneditorform.php';
    }
}