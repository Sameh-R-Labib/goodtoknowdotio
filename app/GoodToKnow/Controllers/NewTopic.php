<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/7/18
 * Time: 3:31 PM
 */

namespace GoodToKnow\Controllers;


class NewTopic
{
    public function page()
    {
        /**
         * We need to determine whether or not
         * the community has any topics.
         * If it has no topics then we assign
         * the sequence number for the new topic
         * a value of 500000 and redirect to
         * where we ask for the name of the topic.
         * If the community has one or more topics
         * then we redirect to where we as for the
         * insertion point.
         */

        global $special_topic_array;
        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (sizeof($special_topic_array) > 0) {
            $is_empty = false;
        } else {
            $is_empty = true;
        }

        if ($is_empty) {
            $_SESSION['saved_int01'] = 500000;
            redirect_to("/ax1/NewTopicName/page");
        } else {
            redirect_to("/ax1/NewTopicInsertPoint/page");
        }
    }
}