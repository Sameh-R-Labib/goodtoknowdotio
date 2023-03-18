<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\community;
use GoodToKnow\Models\community_to_topic;
use GoodToKnow\Models\post;
use GoodToKnow\Models\topic;
use GoodToKnow\Models\topic_to_post;
use GoodToKnow\Models\user;

class set_home_community_topic_post
{
    function page(int $community_id = 0, int $topic_id = 0, int $post_id = 0)
    {
        /**
         * DESCRIPTION
         * ===========
         *
         * This script runs when a user (on home page) clicks a community, a topic, or a post hyperlink.
         * It does its thing then redirects back to the home page.
         *
         * home is the route for displaying a blog resource.
         * A blog resource is either a community, a topic or a post.
         *
         * This route sets up the session so that it is loads data for
         * a particular blog resource.  Then it redirects to home page.
         * The home page presents the resource for viewing. And, although
         * home is being given all the data it needs we have a mechanism
         * which enables home to refresh some of its data.
         *
         * This route makes sure the resource being requested is legitimate.
         *
         * This route will establish the type_of_resource_requested, and
         * it will gather data for the resource. It will establish
         * a time of refresh for (special) data so that the home page will
         * not need to reload them when home is loaded directly after this
         * route yet if the home page is loaded directly (like a page refresh)
         * then the special data will be loaded if it has expired.
         */


        global $g;


        // We want most of the variables to be global,
        // so we can access them in include files.

        $g->topic_id = $topic_id;
        $g->community_id = $community_id;
        $g->post_id = $post_id;


        // Abort if necessary.

        if (!$g->is_logged_in) {

            $_SESSION['message'] = $g->message;

            reset_feature_session_vars();

            redirect_to("/ax1/login_form/page");

        }


        // Get a database connection.

        get_db();


        /**
         * Figure out which type of resource is being requested.
         * Is it a community, a topic or a post?
         */

        if ($g->topic_id == 0) {

            $g->type_of_resource_requested = 'community';
            if ($g->post_id != 0) {
                breakout(" Your resource request is defective. (errno 1) ");
            }

        } else {

            if ($g->post_id === 0) {
                $g->type_of_resource_requested = 'topic';
            } else {
                $g->type_of_resource_requested = 'post';
            }

        }


        /**
         * This section is for these types of resources:
         *
         *      community, topic, post
         */

        // Breakout if the community does not belong to the user.

        if (!array_key_exists($g->community_id, $g->special_community_array)) {

            breakout(" Invalid community_id. ");

        }

        // Store the type of resource requested in the session.
        $_SESSION['type_of_resource_requested'] = $g->type_of_resource_requested;

        // Store the id of each.
        $_SESSION['community_id'] = $g->community_id;
        $_SESSION['topic_id'] = $g->topic_id;
        $_SESSION['post_id'] = $g->post_id;


        /**
         * Get the community object if $g->type_of_resource_requested == 'community').
         * Ideally, we should get it for every request; However, because of the
         * current way navigation works does not facilitate direct links to post
         * then this code is acceptable and saves some steps.
         */

        if ($g->type_of_resource_requested == 'community') {

            require CONTROLLERINCLUDES . DIRSEP . 'read_things_for_a_community_request.php';

        }


        /**
         * This section is for this type of resource: topic
         *
         * Assumption: Gtk.io does not allow users to click on direct links to posts.
         * Users always use the navigation system provided by Gtk.io.
         */

        if ($g->type_of_resource_requested == 'topic') {

            require CONTROLLERINCLUDES . DIRSEP . 'read_things_for_a_topic_request.php';

        }


        /**
         * This section is for this type of resource: post
         *
         * Assumption: Gtk.io does not allow users to click on direct links to posts.
         * Users always use the navigation system provided by Gtk.io.
         */

        if ($g->type_of_resource_requested === 'post') {

            // Breakout if the post id is not in the special post array.
            if (!array_key_exists($g->post_id, $_SESSION['special_post_array'])) {
                breakout(" Your resource request is defective.  (errno 4) ");
            }

            // Get the post object and its content.
            $post_object = post::find_by_id($g->post_id);

            if (!$post_object) {
                breakout(" set_home_community_topic_post says: Error 58498. ");
            }

            $g->post_content = file_get_contents($post_object->html_file);

            if ($g->post_content === false) {
                breakout(" Unable to read the post's html source file. ");
            }

            // Store the post name in the session.
            $_SESSION['post_name'] = $post_object->title;

            // Generate a publishing date for the post and store the post's full name.
            $epoch_time = (int)$post_object->created;

            $publish_date = date("m/d/Y", $epoch_time);

            $_SESSION['post_full_name'] = $post_object->extensionfortitle . ' [' . $publish_date . ']';

            // Store post content and its last refresh time.
            $_SESSION['post_content'] = $g->post_content;
            $_SESSION['last_refresh_content'] = time();

            // Get and store author information.
            $post_author_object = user::find_by_id($post_object->user_id);

            if ($post_author_object === false) {
                breakout(" Unable to get the post author object from the database. ");
            }

            $_SESSION['author_username'] = $post_author_object->username;
            $_SESSION['author_id'] = (int)$post_author_object->id;

        }


        /**
         * Store the message in the session.
         */

        $_SESSION['message'] = $g->message;


        /**
         * Redirect to home page.
         */

        redirect_to("/ax1/home/page");

    }
    
}