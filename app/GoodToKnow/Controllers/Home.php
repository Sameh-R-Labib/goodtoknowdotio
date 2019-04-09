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

        self::logout_the_user_if_he_is_suspended($db, $sessionMessage, $user_id, $when_last_checked_suspend);

        self::refresh_vars_which_may_be_stale($db, $sessionMessage, $special_community_array, $special_topic_array,
            $post_content, $user_id, $community_id, $topic_id, $post_id, $type_of_resource_requested,
            $last_refresh_communities, $last_refresh_topics, $last_refresh_posts, $last_refresh_content);

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
     * @param $db
     * @param $error
     * @param $special_community_array
     * @param $special_topic_array
     * @param $post_content
     * @param $user_id
     * @param $community_id
     * @param $topic_id
     * @param $post_id
     * @param $type_of_resource_requested
     * @param $last_refresh_communities
     * @param $last_refresh_topics
     * @param $last_refresh_posts
     * @param $last_refresh_content
     */
    private static function refresh_vars_which_may_be_stale(&$db, &$error, &$special_community_array, &$special_topic_array,
                                                            &$post_content, $user_id, $community_id, $topic_id, $post_id,
                                                            $type_of_resource_requested, $last_refresh_communities,
                                                            $last_refresh_topics, $last_refresh_posts, $last_refresh_content)
    {
        /**
         * If the special_community_array has not been
         * refreshed for a period of time longer than
         * 3 hours then refresh it.
         */
        $time_since_refresh = time() - $last_refresh_communities;  // seconds
        if ($time_since_refresh > 10800) {
            if ($db == 'not connected') {
                $db = db_connect($error);
                if ($db === false) {
                    $error .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $error;
                    redirect_to("/ax1/InfiniteLoopPrevent/page");
                }
            }
            $special_community_array = EnfoFindCommunitiesOfUser::find_communities_of_user($db, $error, $user_id);
            if ($special_community_array === false) {
                $error .= " Failed to find the array of the user's communities. ";
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
                $db = db_connect($error);
                if ($db === false) {
                    $error .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $error;
                    redirect_to("/ax1/InfiniteLoopPrevent/page");
                }
            }
            $special_topic_array = CommunityToTopic::get_topics_array_for_a_community($db, $error, $community_id);
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
                $db = db_connect($error);
                if ($db === false) {
                    $error .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $error;
                    redirect_to("/ax1/InfiniteLoopPrevent/page");
                }
            }
            $special_post_array = TopicToPost::special_get_posts_array_for_a_topic($db, $error, $topic_id);
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
                $db = db_connect($error);
                if ($db === false) {
                    $error .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $error;
                    redirect_to("/ax1/InfiniteLoopPrevent/page");
                }
            }
            $post_object = Post::find_by_id($db, $error, $post_id);
            if ($post_object === false) {
                $error .= " Home page() says: Unable to get post object from the database. ";
            } else {
                $post_content = file_get_contents($post_object->html_file);
                if ($post_content === false) {
                    $error .= " Unable to read the post's file. ";
                    $post_content = '';
                }
            }
            $_SESSION['post_content'] = $post_content;
            $_SESSION['last_refresh_content'] = time();
        }
    }

    /**
     * @param $db
     * @param $error
     * @param $user_id
     * @param $when_last_checked_suspend
     */
    private static function logout_the_user_if_he_is_suspended(&$db, &$error, $user_id, &$when_last_checked_suspend)
    {
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
        if ($elapsed_time > 400) {
            $when_last_checked_suspend = time();
            $_SESSION['when_last_checked_suspend'] = $when_last_checked_suspend;
            if ($db == 'not connected') {
                $db = db_connect($error);
                if ($db === false) {
                    $error .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $error;
                    redirect_to("/ax1/InfiniteLoopPrevent/page");
                }
            }
            $result = EnforceSuspension::enforce_suspension($db, $error, $user_id);
            if ($result === false) {
                $error .= " Failed to find the user by id. ";
                $_SESSION['message'] = $error;
                redirect_to("/ax1/InfiniteLoopPrevent/page");
            }
        }
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