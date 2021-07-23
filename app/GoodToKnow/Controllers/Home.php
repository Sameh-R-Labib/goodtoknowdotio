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


        /**
         * SetHomePageCommunityTopicPost does set all these vars. However, since the user may
         * just hit refresh in browser, it's good to refresh these variables (once in a while
         * on the Home page.)
         *
         * Not every variable is refreshed. Just the main ones.
         */
        self::refresh_vars_which_may_be_stale();


        /**
         * Home should always present a message.
         */
        self::put_together_a_good_sessionmessage();


        /**
         * Announce something about the quantity of inbox messages.
         *
         * This, also, gets appended to the session message.
         */
        require CONTROLLERINCLUDES . DIRSEP . 'check_messages.php';


        /**
         * Sets a few vars ans summons the view.
         */
        self::show_the_home_page();
    }


    private static function show_the_home_page()
    {
        global $g;


        /**
         * false is JUST to indicate to the view that this is the Home page.
         * The view will still show the author messaging link if Home is showing a post.
         */
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


        /**
         * We need these br tags to preced the buttons.
         */

        $g->message .= '<br>';


        $g->message .= ' <a class="clearbtn" href="/ax1/Upload/page">Upload 🖼️</a> ';


        if ($g->type_of_resource_requested == 'topic') {

            $g->message .= ' <a class="greenbtn" href="/ax1/CreateNewPostDirect/page">Create 📄</a> ';

        }


        if ($g->type_of_resource_requested == 'post' and $g->author_id == $g->user_id) {

            $g->message .= ' <a class="purplebtn" href="/ax1/EditMyPostDirect/page">Edit 📄</a> ';
        }

    }


    private static function refresh_vars_which_may_be_stale()
    {
        /**
         * If the special_community_array has not been
         * refreshed for a period of time longer than
         * 23 seconds then refresh it.
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
            $g->last_refresh_communities = time();
            $_SESSION['last_refresh_communities'] = $g->last_refresh_communities;
        }


        /**
         * If the type_of_resource_requested == 'community'
         * and the special_topic_array has not been refreshed
         * for a period longer than 20 seconds then refresh it.
         */

        $time_since_refresh = time() - $g->last_refresh_topics;

        if ($time_since_refresh > 20 && $g->type_of_resource_requested == 'community') {

            db_connect_if_not_connected();

            $g->special_topic_array = CommunityToTopic::get_topics_array_for_a_community($g->community_id);

            if ($g->special_topic_array === false) $g->special_topic_array = [];

            $_SESSION['special_topic_array'] = $g->special_topic_array;
            $g->last_refresh_topics = time();
            $_SESSION['last_refresh_topics'] = $g->last_refresh_topics;

        }


        /**
         * If the type_of_resource_requested == 'topic'
         * and the $g->special_post_array has not been refreshed
         * for a period longer than 7 seconds then refresh it.
         */

        $time_since_refresh = time() - $g->last_refresh_posts;

        if ($time_since_refresh > 7 && $g->type_of_resource_requested == 'topic') {

            db_connect_if_not_connected();

            $g->special_post_array = TopicToPost::special_get_posts_array_for_a_topic($g->topic_id);

            if ($g->special_post_array === false) $g->special_post_array = [];

            $_SESSION['special_post_array'] = $g->special_post_array;
            $g->last_refresh_posts = time();
            $_SESSION['last_refresh_posts'] = $g->last_refresh_posts;
        }


        /**
         * If the type_of_resource_requested == 'post'
         * and the post_content has not been refreshed
         * for a period longer than 7 seconds then refresh it.
         */

        $time_since_refresh = time() - $g->last_refresh_content;

        if ($time_since_refresh > 7 && $g->type_of_resource_requested == 'post') {

            db_connect_if_not_connected();

            $g->post_object = Post::find_by_id($g->post_id);

            if ($g->post_object === false) {

                $g->post_content = "[Missing Post Record]";
                $_SESSION['post_content'] = $g->post_content;
                $g->message .= " The Home page says it's unable to get the current post (but that's okay if you've just deleted it.) ";

            } else {

                $g->post_content = file_get_contents($g->post_object->html_file);

                if ($g->post_content === false) {

                    $g->post_content = '[Missing Post Content]';
                    $_SESSION['post_content'] = $g->post_content;
                    $g->message .= " Unable to read the post's file. ";

                }

                /**
                 * You'll notice more than usual amount of things are being
                 * refreshed for a post. I'm doing this to take advantage of
                 * the fact we've retrieved the post object from the database.
                 * As for communities and topics not so much can be efficiently
                 * refreshed.
                 */
                $g->post_name = $g->post_object->title;
                $epoch_time = (int)$g->post_object->created;
                $publish_date = date("m/d/Y T", $epoch_time);
                $g->post_full_name = $g->post_object->extensionfortitle . ' [' . $publish_date . ']';
                $_SESSION['post_name'] = $g->post_name;
                $_SESSION['post_full_name'] = $g->post_full_name;
                $_SESSION['post_content'] = $g->post_content;

            }

            if (empty(trim($g->post_content))) {

                $g->post_content = '<p><em>[No post content]</em></p>';

            }

            /**
             * Whether or not we were able to get the post object and post content
             * we reset the clock since we did something for refreshing the post.
             */
            $g->last_refresh_content = time();
            $_SESSION['last_refresh_content'] = $g->last_refresh_content;

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