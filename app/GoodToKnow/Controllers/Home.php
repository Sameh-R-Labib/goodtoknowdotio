<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\User;
use GoodToKnow\Models\UserToCommunity;
use GoodToKnow\Models\CommunityToTopic;
use GoodToKnow\Models\Post;
use GoodToKnow\Models\TopicToPost;

class Home
{
    function page()
    {
        self::redirect_if_not_logged_in();

        self::logout_the_user_if_he_is_suspended();

        self::refresh_vars_which_may_be_stale();

        self::put_together_a_good_sessionmessage();

        // Announce something about the quantity of inbox messages.
        require CONTROLLERINCLUDES . DIRSEP . 'check_messages.php';

        self::show_the_home_page();
    }


    private static function show_the_home_page()
    {
        global $html_title;
        global $page;
        global $show_poof;

        $show_poof = false;

        $html_title = 'GoodToKnow.io';

        $page = "Home";

        require VIEWS . DIRSEP . 'home.php';
    }


    private static function put_together_a_good_sessionmessage()
    {
        global $sessionMessage;
        global $type_of_resource_requested;
        global $community_description;
        global $topic_description;
        global $post_full_name;

        if ($type_of_resource_requested === 'community') {
            if (!empty(trim($community_description))) {
                if (empty(trim($sessionMessage))) {
                    $sessionMessage .= ' ' . nl2br($community_description, false) . ' ';
                }
            }
        } elseif ($type_of_resource_requested === 'topic') {
            if (!empty(trim($topic_description))) {
                if (empty(trim($sessionMessage))) {
                    $sessionMessage .= ' ' . nl2br($topic_description, false) . ' ';
                }
            }
        } else {
            if (!empty(trim($post_full_name))) {
                if (empty(trim($sessionMessage))) {
                    $sessionMessage .= ' ' . $post_full_name . ' ';
                }
            }
        }

        $sessionMessage .= ' <br><br><a class="greenbtn" href="/ax1/CreateNewPost/page">Create 📄</a>
            <a class="purplebtn" href="/ax1/EditMyPost/page">Edit 📄</a>
            <a class="clearbtn" href="/ax1/Upload/page">Upload 🖼️</a> ';
    }


    private static function refresh_vars_which_may_be_stale()
    {
        /**
         * If the special_community_array has not been
         * refreshed for a period of time longer than
         * 3 hours then refresh it.
         */

        global $db;
        global $sessionMessage;
        global $special_community_array;
        global $special_topic_array;
        global $special_post_array;
        global $post_content;
        global $user_id;
        global $community_id;
        global $topic_id;
        global $post_id;
        global $type_of_resource_requested;
        global $last_refresh_communities;
        global $last_refresh_topics;
        global $last_refresh_posts;
        global $last_refresh_content;

        $time_since_refresh = time() - $last_refresh_communities;  // seconds

        if ($time_since_refresh > 250) {
            if ($db == 'not connected') {
                $db = db_connect($sessionMessage);

                if ($db === false) {
                    $sessionMessage .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $sessionMessage;
                    reset_feature_session_vars();
                    redirect_to("/ax1/InfiniteLoopPrevent/page");
                }
            }

            $special_community_array = UserToCommunity::find_communities_of_user($db, $sessionMessage, $user_id);

            if ($special_community_array === false) {
                $sessionMessage .= " Failed to find the array of the user's communities. ";
            }

            $_SESSION['special_community_array'] = $special_community_array;
            $_SESSION['last_refresh_communities'] = time();
        }


        /**
         * If the type_of_resource_requested == 'community'
         * and the special_topic_array has not been refreshed
         * for a period longer than 4 minutes then refresh it.
         */

        $time_since_refresh = time() - $last_refresh_topics;

        if ($time_since_refresh > 240 && $type_of_resource_requested == 'community') {
            if ($db == 'not connected') {
                $db = db_connect($sessionMessage);

                if ($db === false) {
                    $sessionMessage .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $sessionMessage;
                    reset_feature_session_vars();
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
                    reset_feature_session_vars();
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
                    reset_feature_session_vars();
                    redirect_to("/ax1/InfiniteLoopPrevent/page");
                }
            }

            $post_object = Post::find_by_id($db, $sessionMessage, $post_id);

            if ($post_object === false) {
                $sessionMessage .= " The Home page says it's unable to get the current post (but that's okay if you've just deleted it.) ";
            } else {
                $post_content = file_get_contents($post_object->html_file);

                if ($post_content === false) {
                    $sessionMessage .= " Unable to read the post's file. ";
                    $post_content = '';
                }
            }

            if (empty(trim($post_content))) {
                $post_content = '<p><em>[No post content]</em></p>';
            }

            $_SESSION['post_content'] = $post_content;
            $_SESSION['last_refresh_content'] = time();
        }
    }


    private static function logout_the_user_if_he_is_suspended()
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

        global $db;
        global $sessionMessage;
        global $user_id;
        global $when_last_checked_suspend;

        $elapsed_time = time() - $when_last_checked_suspend;

        if ($elapsed_time > 400) {
            $when_last_checked_suspend = time();

            $_SESSION['when_last_checked_suspend'] = $when_last_checked_suspend;

            if ($db == 'not connected') {
                $db = db_connect($sessionMessage);

                if ($db === false) {
                    $sessionMessage .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $sessionMessage;
                    reset_feature_session_vars();
                    redirect_to("/ax1/InfiniteLoopPrevent/page");
                }
            }

            $result = User::enforce_suspension($db, $sessionMessage, $user_id);

            if ($result === false) {
                $sessionMessage .= " Failed to find the user by id. ";
                $_SESSION['message'] = $sessionMessage;
                reset_feature_session_vars();
                redirect_to("/ax1/InfiniteLoopPrevent/page");
            }
        }
    }


    private static function redirect_if_not_logged_in()
    {
        global $sessionMessage;
        global $is_logged_in;

        if (!$is_logged_in) {

            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/LoginForm/page");

        }
    }
}