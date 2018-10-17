<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/7/18
 * Time: 3:31 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\CommunityToTopic;


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

        global $community_id;
        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        $special_topic_array = CommunityToTopic::get_topics_array_for_a_community($db, $sessionMessage, $community_id);


        /**
         * Debug Code
         */
//        echo "\n<p>Begin debug</p>\n";
//        echo "<br><p>Var_dump \$special_topic_array: </p>\n<pre>";
//        var_dump($special_topic_array);
//        echo "</pre>\n";
//        echo "<br><p>Print_r \$community_id: </p>\n<pre>";
//        print_r($community_id);
//        echo "</pre>\n";
//        die("<br><p>End debug</p>\n");




        if ($special_topic_array == false) $special_topic_array = [];
        $_SESSION['special_topic_array'] = $special_topic_array;
        $_SESSION['last_refresh_topics'] = time();

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