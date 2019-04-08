<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/22/18
 * Time: 9:09 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\CommunityToTopic;
use GoodToKnow\Models\Post;
use GoodToKnow\Models\TopicToPost;


class Home
{
    public function page()
    {
        global $role;                       // string value
        global $user_id;                    // int value
        global $community_id;               // int value
        global $topic_id;                   // int value
        global $post_id;                    // int value
        global $post_name;
        global $post_full_name;
        global $topic_name;
        global $topic_description;
        global $community_name;
        global $community_description;
        global $special_community_array;    // array (key: id of community, value: name of community)
        global $special_topic_array;        // array of topics for current community.
        global $special_post_array;         // array of posts for current topic
        global $post_content;               // string containing the html for current post
        global $author_username;            // author of the current post
        global $type_of_resource_requested; // result of running SetHomePageCommunityTopicPost
        global $last_refresh_communities;
        global $last_refresh_topics;
        global $last_refresh_posts;
        global $last_refresh_content;
        global $sessionMessage;
        global $is_logged_in;
        global $is_admin;
        global $when_last_checked_suspend;  // timestamp
        global $saved_str01;                // string value (temporary storage)
        global $saved_str02;
        global $saved_int01;
        global $saved_int02;

        self::redirect_if_not_logged_in($sessionMessage, $is_logged_in);

        $db = 'not connected';

        /**
         * Logout the user if he is suspended.
         * We are not going to check to see if he is suspended
         * every time this page loads. There will be a session
         * variable called $when_last_checked_suspend which
         * will record the timestamp of the last check to make
         * sure he wasn't suspended.
         *
         * All this will be encapsulated in a function called:
         * enforce_suspension
         *
         * This function will take arguments:
         *   A) $db
         *   B) The ID of the logged in user
         *   C) $when_last_checked_suspend (which is a timestamp)
         *
         * Within the function it will:
         *   1) Skip everything if it's too soon.
         *   2) Determine whether or not the user is suspended per database
         *   3) If the user is suspended log him out and redirect to the page for logging in.
         *   4) Otherwise, return control over to where the function was called.
         */

        $elapsed_time = time() - $when_last_checked_suspend;
        $when_last_checked_suspend = time();
        if ($elapsed_time < 400) {
            if ($db == 'not connected') {
                $db = db_connect($sessionMessage);
                if ($db === false) {
                    $sessionMessage .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $sessionMessage;
                    redirect_to("/ax1/InfiniteLoopPrevent/page");
                }
            }

            $result = EnforceSuspension::enforce_suspension($db, $sessionMessage, $user_id, $when_last_checked_suspend);
            if ($result === false) {
                $sessionMessage .= " Failed to find the user by id. ";
                $_SESSION['message'] = $sessionMessage;
                redirect_to("/ax1/InfiniteLoopPrevent/page");
            }
            // $when_last_checked_suspend may have been changed by EnforceSuspension::enforce_suspension
            $_SESSION['when_last_checked_suspend'] = $when_last_checked_suspend;
        }

        /**
         * If the special_community_array has not been
         * refreshed for a period of time longer than
         * 3 hours then refresh it.
         */
        $time_since_refresh = time() - $last_refresh_communities;  // seconds
        if ($time_since_refresh > 10800) {
            if ($db == 'not connected') {
                $db = db_connect($sessionMessage);
                if ($db === false) {
                    $sessionMessage .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $sessionMessage;
                    redirect_to("/ax1/InfiniteLoopPrevent/page");
                }
            }
            $special_community_array = EnfoFindCommunitiesOfUser::find_communities_of_user($db, $sessionMessage, $user_id);
            if ($special_community_array === false) {
                $sessionMessage .= " Failed to find the array of the user's communities. ";
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
                if ($db === false) {
                    $sessionMessage .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $sessionMessage;
                    redirect_to("/ax1/InfiniteLoopPrevent/page");
                }
            }
            $special_topic_array = CommunityToTopic::get_topics_array_for_a_community($db, $sessionMessage, $community_id);
            if ($special_topic_array === false) $special_topic_array = [];
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
                if ($db === false) {
                    $sessionMessage .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $sessionMessage;
                    redirect_to("/ax1/InfiniteLoopPrevent/page");
                }
            }
            $special_post_array = TopicToPost::special_get_posts_array_for_a_topic($db, $sessionMessage, $topic_id);
            if ($special_post_array === false) $special_post_array = [];
            $_SESSION['special_post_array'] = $special_post_array;
            $_SESSION['last_refresh_posts'] = time();
        }

        /**
         * If the type_of_resource_requested == 'post'
         * and the post_content has not been refreshed
         * for a period longer than 3 minutes then refresh it.
         */
        $time_since_refresh = time() - $last_refresh_content;
        if ($time_since_refresh > 180 && $type_of_resource_requested == 'post') {
            if ($db == 'not connected') {
                $db = db_connect($sessionMessage);
                if ($db === false) {
                    $sessionMessage .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $sessionMessage;
                    redirect_to("/ax1/InfiniteLoopPrevent/page");
                }
            }
            $post_object = Post::find_by_id($db, $sessionMessage, $post_id);
            if ($post_object === false) {
                $sessionMessage .= " Home page() says: Unable to get post object from the database. ";
            } else {
                $post_content = file_get_contents($post_object->html_file);
                if ($post_content === false) {
                    $sessionMessage .= " Unable to read the post's file. ";
                    $post_content = '';
                }
            }
            $_SESSION['post_content'] = $post_content;
            $_SESSION['last_refresh_content'] = time();
        }

        if ($type_of_resource_requested === 'community') {
            if (!empty(trim($community_description))) {
                if (empty(trim($sessionMessage))) {
                    $sessionMessage .= ' ' . $community_description . ' ';
                }
            }
        } elseif ($type_of_resource_requested === 'topic') {
            if (!empty(trim($topic_description))) {
                if (empty(trim($sessionMessage))) {
                    $sessionMessage .= ' ' . $topic_description . ' ';
                }
            }
        } else {
            if (!empty(trim($post_full_name))) {
                if (empty(trim($sessionMessage))) {
                    $sessionMessage .= ' ' . $post_full_name . ' ';
                }
            }
        }

        $show_poof = false;

        $html_title = 'GoodToKnow.io';

        $page = "Home";

        require VIEWS . DIRSEP . 'home.php';
    }

    /**
     * @param $error
     * @param bool $is_logged_in
     */
    private static function redirect_if_not_logged_in($error, bool $is_logged_in)
    {
        if (!$is_logged_in) {
            $_SESSION['message'] = $error;
            redirect_to("/ax1/LoginForm/page");
        }
    }
}