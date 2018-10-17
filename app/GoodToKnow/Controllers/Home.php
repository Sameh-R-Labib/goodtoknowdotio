<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/22/18
 * Time: 9:09 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\CommunityToTopic;
use GoodToKnow\Models\TopicToPost;
use GoodToKnow\Models\UserToCommunity;
use GoodToKnow\Models\Community;


class Home
{
    public function page()
    {
        global $role;                       // string value
        global $user_id;                    // int value
        global $community_id;               // int value
        global $topic_id;                   // int value
        global $post_id;                    // int value
        global $special_community_array;    // array (key: id of community, value: name of community)
        global $special_topic_array;        // array of topics for current community.
        global $special_post_array;         // array of posts for current topic
        global $post_content;               // string containing the html for current post
        global $type_of_resource_requested; // result of running SetHomePageCommunityTopicPost
        global $last_refresh_communities;
        global $last_refresh_topics;
        global $last_refresh_posts;
        global $sessionMessage;
        global $is_logged_in;
        global $is_admin;
        global $saved_str01;                // string value (temporary storage)
        global $saved_str02;
        global $saved_int01;
        global $saved_int02;


        /**
         * Debug Code
         */
//        echo "\n<p>Begin debug</p>\n";
//        echo "<br><p>Var_dump \$_SESSION: </p>\n<pre>";
//        var_dump($_SESSION);
//        echo "</pre>\n";
//        echo "<br><p>Print_r \$community_id: </p>\n<pre>";
//        print_r($community_id);
//        echo "</pre>\n";
//        die("<br><p>End debug</p>\n");





        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        $db = 'not connected';

        /**
         * If the special_community_array has not been
         * refreshed for a period of time longer than
         * 3 hours then refresh it.
         */
        $time_since_refresh = time() - $last_refresh_communities;  // seconds
        if ($time_since_refresh > 10800) {
            $db = db_connect($sessionMessage);
            if (!empty($sessionMessage)) {
                $_SESSION['message'] = $sessionMessage;
                redirect_to("/ax1/Home/page");
            }
            $sql = 'SELECT * FROM user_to_community WHERE `user_id`=' . $user_id;
            $user_to_community_array = UserToCommunity::find_by_sql($db, $sessionMessage, $sql);
            if (!$user_to_community_array) {
                $sessionMessage .= " Home page() says unexpected no user_to_community_array. ";
                $_SESSION['message'] = $sessionMessage;
                redirect_to("/ax1/Home/page");
            }
            $special_community_array = [];
            foreach ($user_to_community_array as $value) {
                // Talking about the right side of the assignment statement
                // First we're getting a Community object
                $special_community_array[$value->community_id] = Community::find_by_id($db, $sessionMessage, $value->community_id);
                if (!$special_community_array[$value->community_id]) {
                    $sessionMessage .= " Home page() says err_no 30848. ";
                    $_SESSION['message'] = $sessionMessage;
                    redirect_to("/ax1/Home/page");
                }
                // Then we're getting the community_name from that object
                $special_community_array[$value->community_id] = $special_community_array[$value->community_id]->community_name;
            }
            $_SESSION['special_community_array'] = $special_community_array;
            $_SESSION['last_refresh_communities'] = time();
        }

        /**
         * If the type_of_resource_requested == 'community'
         * and the special_topic_array has not been refreshed
         * for a period longer than 12 minutes then refresh it.
         */
        $time_since_refresh = time() - $last_refresh_topics;
        if ($time_since_refresh > 720 && $type_of_resource_requested == 'community') {
            if ($db == 'not connected') {
                $db = db_connect($sessionMessage);
                if (!empty($sessionMessage)) {
                    $_SESSION['message'] = $sessionMessage;
                    redirect_to("/ax1/Home/page");
                }
            }
            $special_topic_array = CommunityToTopic::get_topics_array_for_a_community($db, $sessionMessage, $community_id);
            if ($special_topic_array == false) $special_topic_array = [];
            $_SESSION['special_topic_array'] = $special_topic_array;
            $_SESSION['last_refresh_topics'] = time();
        }

        /**
         * If the type_of_resource_requested == 'topic'
         * and the special_post_array has not been refreshed
         * for a period longer than 3 minutes then refresh it.
         */
        $time_since_refresh = time() - $last_refresh_posts;
        if ($time_since_refresh > 180 && $type_of_resource_requested == 'topic') {
            if ($db == 'not connected') {
                $db = db_connect($sessionMessage);
                if (!empty($sessionMessage)) {
                    $_SESSION['message'] = $sessionMessage;
                    redirect_to("/ax1/Home/page");
                }
            }
            $special_post_array = TopicToPost::special_get_posts_array_for_a_topic($db, $sessionMessage, $topic_id);
            if ($special_post_array == false) $special_post_array = [];
            $_SESSION['special_post_array'] = $special_post_array;
            $_SESSION['last_refresh_posts'] = time();
        }

        $html_title = 'GoodToKnow.io';

        require VIEWS . DIRSEP . 'home.php';
    }
}