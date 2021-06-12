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
        global $g;

        $g->show_poof = false;

        $g->html_title = 'GoodToKnow.io';

        $g->page = "Home";

        require VIEWS . DIRSEP . 'home.php';
    }


    private static function put_together_a_good_sessionmessage()
    {
        global $g;

        if ($g->type_of_resource_requested === 'community') {

            if (!empty(trim($g->community_description))) {

                if (empty(trim($g->message))) {
                    $g->message .= ' ' . nl2br($g->community_description, false) . ' ';
                }

            }

        } elseif ($g->type_of_resource_requested === 'topic') {

            if (!empty(trim($g->topic_description))) {

                if (empty(trim($g->message))) {
                    $g->message .= ' ' . nl2br($g->topic_description, false) . ' ';
                }

            }

        } else {

            if (!empty(trim($g->post_full_name))) {

                if (empty(trim($g->message))) {
                    $g->message .= ' ' . $g->post_full_name . ' ';
                }

            }

        }

        $g->message .= ' <br><br><a class="greenbtn" href="/ax1/CreateNewPost/page">Create 📄</a>
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

        global $g;

        $time_since_refresh = time() - $g->last_refresh_communities;  // seconds

        if ($time_since_refresh > 23) {

            db_connect_if_not_connected();

            $g->special_community_array = UserToCommunity::find_communities_of_user($g->user_id);

            if ($g->special_community_array === false) {

                $g->message .= " Failed to find the array of the user's communities. ";

            }

            $_SESSION['special_community_array'] = $g->special_community_array;
            $_SESSION['last_refresh_communities'] = time();
        }


        /**
         * If the type_of_resource_requested == 'community'
         * and the special_topic_array has not been refreshed
         * for a period longer than 4 minutes then refresh it.
         */

        $time_since_refresh = time() - $g->last_refresh_topics;

        if ($time_since_refresh > 20 && $g->type_of_resource_requested == 'community') {

            db_connect_if_not_connected();

            $g->special_topic_array = CommunityToTopic::get_topics_array_for_a_community($g->community_id);

            if ($g->special_topic_array === false) $g->special_topic_array = [];

            $_SESSION['special_topic_array'] = $g->special_topic_array;
            $_SESSION['last_refresh_topics'] = time();

        }


        /**
         * If the type_of_resource_requested == 'topic'
         * and the $g->special_post_array has not been refreshed
         * for a period longer than 3 minutes then refresh it.
         */

        $time_since_refresh = time() - $g->last_refresh_posts;

        if ($time_since_refresh > 7 && $g->type_of_resource_requested == 'topic') {

            db_connect_if_not_connected();

            $g->special_post_array = TopicToPost::special_get_posts_array_for_a_topic($g->topic_id);

            if ($g->special_post_array === false) $g->special_post_array = [];

            $_SESSION['special_post_array'] = $g->special_post_array;
            $_SESSION['last_refresh_posts'] = time();
        }


        /**
         * If the type_of_resource_requested == 'post'
         * and the post_content has not been refreshed
         * for a period longer than 3 minutes then refresh it.
         */

        $time_since_refresh = time() - $g->last_refresh_content;

        if ($time_since_refresh > 7 && $g->type_of_resource_requested == 'post') {

            db_connect_if_not_connected();

            $g->post_object = Post::find_by_id($g->post_id);

            if ($g->post_object === false) {

                $g->message .= " The Home page says it's unable to get the current post (but that's okay if you've just deleted it.) ";

            } else {

                $g->post_content = file_get_contents($g->post_object->html_file);

                if ($g->post_content === false) {

                    $g->message .= " Unable to read the post's file. ";
                    $g->post_content = '';

                }

            }

            if (empty(trim($g->post_content))) {

                $g->post_content = '<p><em>[No post content]</em></p>';

            }

            $_SESSION['post_content'] = $g->post_content;
            $_SESSION['last_refresh_content'] = time();

        }
    }


    private static function logout_the_user_if_he_is_suspended()
    {
        /**
         * Logout the user if he is suspended.
         * We are not going to check to see if he is suspended
         * every time this page loads. There will be a session
         * variable called $g->when_last_checked_suspend which
         * will record the timestamp of the last check to make
         * sure he wasn't suspended.
         *
         * All this will be encapsulated in a function called:
         * enforce_suspension
         *
         * This function will take arguments:
         *   A) $g->db
         *   B) The ID of the logged in user
         *   C) $g->when_last_checked_suspend (which is a timestamp)
         *
         * Within the function it will:
         *   1) Skip everything if it's too soon.
         *   2) Determine whether or not the user is suspended per database
         *   3) If the user is suspended log him out and redirect to the page for logging in.
         *   4) Otherwise, return control over to where the function was called.
         */

        global $g;

        $elapsed_time = time() - $g->when_last_checked_suspend;

        if ($elapsed_time > 400) {

            $g->when_last_checked_suspend = time();

            $_SESSION['when_last_checked_suspend'] = $g->when_last_checked_suspend;

            db_connect_if_not_connected();

            $result = User::enforce_suspension();

            if ($result === false) {

                $g->message .= " Failed to find the user by id. ";
                $_SESSION['message'] = $g->message;
                reset_feature_session_vars();
                redirect_to("/ax1/InfiniteLoopPrevent/page");

            }

        }

    }


    private static function redirect_if_not_logged_in()
    {
        global $g;

        if (!$g->is_logged_in) {

            $_SESSION['message'] = $g->message;
            reset_feature_session_vars();
            redirect_to("/ax1/LoginForm/page");

        }
    }
}