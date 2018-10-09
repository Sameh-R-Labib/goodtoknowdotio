<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/9/18
 * Time: 2:24 PM
 */

namespace GoodToKnow\Controllers;


class NewTopicInsertPoint
{
    public function page()
    {
        /**
         * The goal is to present a form
         * for specifying the location for
         * inserting the new topic.
         * The user answers two questions:
         *  1) Before or After?
         *  2) Which topic?
         *
         * Note: Here it is assumed there is at
         * least one topic in the community.
         * Otherwise, this route will have had been skipped.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $special_topic_array;

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Where will the new topic go?';

        require VIEWS . DIRSEP . 'newtopicinsertpoint.php';
    }
}