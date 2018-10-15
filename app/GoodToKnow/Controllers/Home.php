<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/22/18
 * Time: 9:09 PM
 */

namespace GoodToKnow\Controllers;


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

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

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
        }

        $html_title = 'GoodToKnow.io';

        require VIEWS . DIRSEP . 'home.php';
    }
}