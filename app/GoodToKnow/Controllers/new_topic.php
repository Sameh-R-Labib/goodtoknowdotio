<?php

namespace GoodToKnow\Controllers;

class new_topic
{
    function page()
    {
        /**
         * We need to determine whether the community has any topics.
         * If it has no topics then we assign the sequence number for the new topic
         * a value of 10500000 and redirect to where we ask for the name of the topic.
         * If the community has one or more topics, then we redirect to where we as for the
         * insertion point.
         */


        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_special_topic_array.php';


        if (sizeof($g->special_topic_array) > 0) {
            $is_empty = false;
        } else {
            $is_empty = true;
        }


        if ($is_empty) {
            $_SESSION['saved_int01'] = 10000;
            redirect_to("/ax1/new_topic_name/page");
        } else {
            redirect_to("/ax1/new_topic_insert_point/page");
        }
    }
}