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
        global $app_state;

        if ($app_state->type_of_resource_requested === 'community') {

            if (!empty(trim($app_state->community_description))) {

                if (empty(trim($app_state->message))) {
                    $app_state->message .= ' ' . nl2br($app_state->community_description, false) . ' ';
                }

            }

        } elseif ($app_state->type_of_resource_requested === 'topic') {

            if (!empty(trim($app_state->topic_description))) {

                if (empty(trim($app_state->message))) {
                    $app_state->message .= ' ' . nl2br($app_state->topic_description, false) . ' ';
                }

            }

        } else {

            if (!empty(trim($app_state->post_full_name))) {

                if (empty(trim($app_state->message))) {
                    $app_state->message .= ' ' . $app_state->post_full_name . ' ';
                }

            }

        }

        $app_state->message .= ' <br><br><a class="greenbtn" href="/ax1/CreateNewPost/page">Create 📄</a>
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

        global $app_state;
        global $db;

        $time_since_refresh = time() - $app_state->last_refresh_communities;  // seconds

        if ($time_since_refresh > 250) {
            if ($db == 'not connected') {

                $db = db_connect();

                if ($db === false) {
                    $app_state->message .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $app_state->message;
                    reset_feature_session_vars();
                    redirect_to("/ax1/InfiniteLoopPrevent/page");
                }

            }

            $app_state->special_community_array = UserToCommunity::find_communities_of_user($app_state->user_id);

            if ($app_state->special_community_array === false) {

                $app_state->message .= " Failed to find the array of the user's communities. ";

            }

            $_SESSION['special_community_array'] = $app_state->special_community_array;
            $_SESSION['last_refresh_communities'] = time();
        }


        /**
         * If the type_of_resource_requested == 'community'
         * and the special_topic_array has not been refreshed
         * for a period longer than 4 minutes then refresh it.
         */

        $time_since_refresh = time() - $app_state->last_refresh_topics;

        if ($time_since_refresh > 240 && $app_state->type_of_resource_requested == 'community') {

            if ($db == 'not connected') {

                $db = db_connect();

                if ($db === false) {

                    $app_state->message .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $app_state->message;
                    reset_feature_session_vars();
                    redirect_to("/ax1/InfiniteLoopPrevent/page");

                }

            }

            $app_state->special_topic_array = CommunityToTopic::get_topics_array_for_a_community($app_state->community_id);

            if ($app_state->special_topic_array === false) $app_state->special_topic_array = [];

            $_SESSION['special_topic_array'] = $app_state->special_topic_array;
            $_SESSION['last_refresh_topics'] = time();

        }


        /**
         * If the type_of_resource_requested == 'topic'
         * and the $app_state->special_post_array has not been refreshed
         * for a period longer than 3 minutes then refresh it.
         */

        $time_since_refresh = time() - $app_state->last_refresh_posts;

        if ($time_since_refresh > 180 && $app_state->type_of_resource_requested == 'topic') {
            if ($db == 'not connected') {

                $db = db_connect();

                if ($db === false) {

                    $app_state->message .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $app_state->message;
                    reset_feature_session_vars();
                    redirect_to("/ax1/InfiniteLoopPrevent/page");

                }

            }

            $app_state->special_post_array = TopicToPost::special_get_posts_array_for_a_topic($app_state->topic_id);

            if ($app_state->special_post_array === false) $app_state->special_post_array = [];

            $_SESSION['special_post_array'] = $app_state->special_post_array;
            $_SESSION['last_refresh_posts'] = time();
        }


        /**
         * If the type_of_resource_requested == 'post'
         * and the post_content has not been refreshed
         * for a period longer than 3 minutes then refresh it.
         */

        $time_since_refresh = time() - $app_state->last_refresh_content;

        if ($time_since_refresh > 180 && $app_state->type_of_resource_requested == 'post') {

            if ($db == 'not connected') {

                $db = db_connect();

                if ($db === false) {

                    $app_state->message .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $app_state->message;
                    reset_feature_session_vars();
                    redirect_to("/ax1/InfiniteLoopPrevent/page");

                }

            }

            $post_object = Post::find_by_id($app_state->post_id);

            if ($post_object === false) {

                $app_state->message .= " The Home page says it's unable to get the current post (but that's okay if you've just deleted it.) ";

            } else {

                $app_state->post_content = file_get_contents($post_object->html_file);

                if ($app_state->post_content === false) {

                    $app_state->message .= " Unable to read the post's file. ";
                    $app_state->post_content = '';

                }

            }

            if (empty(trim($app_state->post_content))) {

                $app_state->post_content = '<p><em>[No post content]</em></p>';

            }

            $_SESSION['post_content'] = $app_state->post_content;
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
        global $app_state;
        global $when_last_checked_suspend;

        $elapsed_time = time() - $when_last_checked_suspend;

        if ($elapsed_time > 400) {
            $when_last_checked_suspend = time();

            $_SESSION['when_last_checked_suspend'] = $when_last_checked_suspend;

            if ($db == 'not connected') {

                $db = db_connect();

                if ($db === false) {

                    $app_state->message .= " Failed to connect to the database. ";
                    $_SESSION['message'] = $app_state->message;
                    reset_feature_session_vars();
                    redirect_to("/ax1/InfiniteLoopPrevent/page");

                }

            }

            $result = User::enforce_suspension();

            if ($result === false) {

                $app_state->message .= " Failed to find the user by id. ";
                $_SESSION['message'] = $app_state->message;
                reset_feature_session_vars();
                redirect_to("/ax1/InfiniteLoopPrevent/page");

            }
        }
    }


    private static function redirect_if_not_logged_in()
    {
        global $app_state;
        global $is_logged_in;

        if (!$is_logged_in) {

            $_SESSION['message'] = $app_state->message;
            reset_feature_session_vars();
            redirect_to("/ax1/LoginForm/page");

        }
    }
}