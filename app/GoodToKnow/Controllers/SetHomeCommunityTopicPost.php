<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Community;
use GoodToKnow\Models\CommunityToTopic;
use GoodToKnow\Models\Topic;
use GoodToKnow\Models\TopicToPost;

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

        get_db();


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


        if ($g->type_of_resource_requested === 'topic_or_post') {

            if ($g->post_id === 0 && $g->topic_id !== 0) {

                $g->type_of_resource_requested = 'topic';

            } elseif ($g->post_id !== 0 && $g->topic_id !== 0) {

                $g->type_of_resource_requested = 'post';

            } else {

                breakout(' Anomalous situation #2954. ');

            }

        }


        /**
         * This section is for these types of resources:
         *
         *      Community, Topic, Post
         */


        // Breakout if the Community does not belong to the user.

        if (!array_key_exists($g->community_id, $g->special_community_array)) {

            breakout(' Invalid community_id. ');

        }


        // Get and store the special topic array.

        $g->special_topic_array = CommunityToTopic::get_topics_array_for_a_community($g->community_id);

        if (!$g->special_topic_array) {

            $g->special_topic_array = [];

        }

        $_SESSION['special_topic_array'] = $g->special_topic_array;
        $_SESSION['last_refresh_topics'] = time();


        // Breakout if the user specified topic id is non-zero and is not in $g->special_topic_array.

        if ($g->topic_id != 0 && !array_key_exists($g->topic_id, $g->special_topic_array)) {

            breakout(' Your resource request is defective.  (errno 6) ');

        }


        // Get the community object.

        $g->community_object = Community::find_by_id($g->community_id);


        // Store the community name and community description in the session.

        $_SESSION['community_name'] = $g->community_object->community_name;
        $_SESSION['community_description'] = $g->community_object->community_description;


        // Store the type of resource requested in the session.

        $_SESSION['type_of_resource_requested'] = $g->type_of_resource_requested;


        // Store the id of each.

        $_SESSION['community_id'] = $g->community_id;
        $_SESSION['topic_id'] = $g->topic_id;
        $_SESSION['post_id'] = $g->post_id;


        /**
         * This section is for these types of resources:
         *
         *      Topic, Post
         */

        if ($g->type_of_resource_requested == 'topic' or $g->type_of_resource_requested == 'post') {

            // Get the Topic object.

            $g->topic_object = Topic::find_by_id($g->topic_id);


            // Store the Topic name and description.

            $_SESSION['topic_name'] = $g->topic_object->topic_name;
            $_SESSION['topic_description'] = $g->topic_object->topic_description;


            // Get a fresh copy of $g->special_post_array.

            $g->special_post_array = TopicToPost::special_get_posts_array_for_a_topic($g->topic_id);

            if (!$g->special_post_array) {

                $g->special_post_array = [];

            }


            // Store the special post array.

            $_SESSION['special_post_array'] = $g->special_post_array;
            $_SESSION['last_refresh_posts'] = time();


            /**
             * This section is for this type of resource:
             *
             *      Post
             */

        }

    }
}