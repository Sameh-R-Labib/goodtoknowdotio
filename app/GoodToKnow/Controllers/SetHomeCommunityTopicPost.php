<?php

namespace GoodToKnow\Controllers;

class SetHomeCommunityTopicPost
{
    public function page(int $community_id = 0, int $topic_id = 0, int $post_id = 0)
    {
        /**
         * DESCRIPTION
         * ===========
         *
         * This script runs when a user (on Home page) clicks a community, a topic, or a post hyperlink.
         * It does its thing then redirects back to the Home page.
         *
         * Home is the route for displaying a blog resource.
         * A blog resource is either a Community, a Topic or a Post.
         *
         * This route sets up the session so that it is loads data for
         * a particular blog resource.  Then it redirects to Home page.
         * The Home page presents the resource for viewing. And, although
         * Home is being given all the data it needs we have a mechanism
         * which enables Home to refresh some of its data.
         *
         * This route makes sure the resource being requested is legitimate.
         *
         * This route will establish the type_of_resource_requested, and
         * it will gather data for the resource. It will establish
         * a time of refresh for (special) data so that the Home page will
         * not need to reload them when Home is loaded directly after this
         * route yet if the home page is loaded directly (like a page refresh)
         * then the special data will be loaded if it has expired.
         */


        global $g;


        // Globalize these to make available inside functions.

        $g->community_id = $community_id;
        $g->topic_id = $topic_id;
        $g->post_id = $post_id;


        // Abort if necessary.

        if (!$g->is_logged_in || !empty($g->message)) {

            $_SESSION['message'] = $g->message;

            reset_feature_session_vars();

            redirect_to("/ax1/LoginForm/page");

        }


        // Get a database connection.

        $g->db = db_connect();


        /**
         * Figure out which type of resource is being requested.
         * Is it a Community, a Topic or a Post?
         */

        if ($g->topic_id == 0) {

            $g->type_of_resource_requested = 'community';

            if ($g->post_id != 0) {

                breakout(' Your resource request is defective. (errno 1) ');

            }

        } else {

            $g->type_of_resource_requested = 'topic_or_post';

        }


        if ($g->post_id === 0 && $g->topic_id !== 0) {

            $g->type_of_resource_requested = 'topic';

        } elseif ($g->post_id !== 0 && $g->topic_id !== 0) {

            $g->type_of_resource_requested = 'post';

        } else {

            breakout(' Anomalous situation #2954. ');

        }
        
    }
}