<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\status;
use GoodToKnow\Models\user;
use GoodToKnow\Models\user_to_community;

class home
{
    function page()
    {
        self::redirect_if_not_logged_in();


        self::logout_the_user_if_he_is_suspended();


        // set_home_community_topic_post does set all these vars. However, since the user may
        // just hit refresh in browser, it's good to refresh these variables (once in a while
        // on the home page.)
        //
        // Not every variable is refreshed. Just the main ones.
        self::refresh_vars_which_may_be_stale();


        // This creates html button for inbox messages.
        require CONTROLLERINCLUDES . DIRSEP . 'check_messages.php';


        self::put_together_message_and_buttons();


        self::add_alert_to_message();


        // Sets a few variables and summons the view.
        self::show_the_home_page();
    }


    private static function show_the_home_page()
    {
        global $g;


        /**
         * false is JUST to indicate to the view that this is the home page.
         * The view will still show the author messaging link if home is showing a post.
         */
        $g->show_poof = false;


        $g->html_title = 'Blog';


        $g->page = "home";

        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'home.php';
    }


    static function add_alert_to_message()
    {
        global $g;

        $elapsed_time = time() - $g->when_last_checked_system_alert;

        if ($elapsed_time > 52) {

            $g->when_last_checked_system_alert = time();

            $_SESSION['when_last_checked_system_alert'] = $g->when_last_checked_system_alert;

            db_connect_if_not_connected();

            $status_object = status::find_by_id(2);

            if (!$status_object) {

                breakout(' ERROR 22038626: The status object could not be found. ');

            }

            if ($status_object->name !== 'system_alert' and $status_object->name !== 'no_alert') {

                breakout(' ERROR 322484: The status name is invalid. ');

            }

            if ($status_object->name == 'system_alert') {

                $g->message .= "\n<br><span class=\"blinking\">🚷 $status_object->message </span> ";

            }

        }
    }


    static function put_together_message_and_buttons()
    {
        global $g;

        if ($g->type_of_resource_requested === 'community') {

            if (!empty(trim($g->community_description)) and empty(trim($g->message))) {
                $g->message = ' ' . nl2br($g->community_description, false) . ' ';
            }
            $g->the_buttons .= '<a class="orangebtn" href="/ax1/write_to_admin/page">Admin Adds Topics</a> ';

        } elseif ($g->type_of_resource_requested === 'topic') {

            if (!empty(trim($g->topic_description)) and empty(trim($g->message))) {
                $g->message = ' ' . nl2br($g->topic_description, false) . ' ';
            }
            $g->the_buttons .= '<a class="clearbtn" href="/ax1/upload/page">Upload 🖼️ for ⇒</a> ';
            $g->the_buttons .= ' <a class="greenbtn" href="/ax1/create_new_post_direct/page">Create 📄</a> ';
            if ($g->is_admin) $g->the_buttons .= ' <a class="purplebtn" href="/ax1/move_post/page">Move a Post</a> ';

        } else {

            if (!empty(trim($g->post_full_name)) and empty(trim($g->message))) {
                $g->message = ' ' . $g->post_full_name . ' ';
            }
            if ($g->author_id == $g->user_id) {
                $g->the_buttons .= '<a class="clearbtn" href="/ax1/upload/page">Upload 🖼️</a> ';
                $g->the_buttons .= ' <a class="purplebtn" href="/ax1/edit_my_post_direct/page">Edit Content of 📄</a> ';
                $g->the_buttons .= ' <a class="orangebtn" href="/ax1/edit_post_title_direct/page">Edit Title of 📄</a> ';
            }

        }
        $g->the_buttons .= $g->messages_button;
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

            $g->special_community_array = user_to_community::find_communities_of_user($g->user_id);

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

            require CONTROLLERINCLUDES . DIRSEP . 'read_things_for_a_community_request.php';

        }


        /**
         * If the type_of_resource_requested == 'topic'
         * and the $g->special_post_array has not been refreshed
         * for a period longer than 7 seconds then refresh it.
         */

        $time_since_refresh = time() - $g->last_refresh_posts;

        if ($time_since_refresh > 7 && $g->type_of_resource_requested == 'topic') {

            db_connect_if_not_connected();

            require CONTROLLERINCLUDES . DIRSEP . 'read_things_for_a_topic_request.php';

        }


        /**
         * If the type_of_resource_requested == 'post'
         * and the post_content has not been refreshed
         * for a period longer than 7 seconds then refresh it.
         */

        $time_since_refresh = time() - $g->last_refresh_content;

        if ($time_since_refresh > 7 && $g->type_of_resource_requested == 'post') {

            db_connect_if_not_connected();

            require CONTROLLERINCLUDES . DIRSEP . 'read_things_for_a_post_request.php';

        }

    }


    static function logout_the_user_if_he_is_suspended()
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
         *   B) The ID of the logged-in user
         *   C) $g->when_last_checked_suspend (which is a timestamp)
         *
         * Within the function it will:
         *   1) Skip everything if it's too soon.
         *   2) Determine whether (or not) the user is suspended per database.
         *   3) If the user is suspended log him out and redirect to the page for logging in.
         *   4) Otherwise, return control over to where the function was called.
         */

        global $g;

        $elapsed_time = time() - $g->when_last_checked_suspend;

        if ($elapsed_time > 52) {

            $g->when_last_checked_suspend = time();

            $_SESSION['when_last_checked_suspend'] = $g->when_last_checked_suspend;

            db_connect_if_not_connected();

            $result = user::enforce_suspension();

            if ($result === false) {

                breakout(" Failed to find the user by id. ");

            }

        }

    }


    static function redirect_if_not_logged_in()
    {
        global $g;

        if (!$g->is_logged_in or $_SESSION['agree_to_tos'] !== 'agree') {

            reset_feature_session_vars();
            redirect_to("/ax1/logout/page");

        }

        offline_enforcement();
    }
}