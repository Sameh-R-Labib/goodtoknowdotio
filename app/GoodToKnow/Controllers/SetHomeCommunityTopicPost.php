<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Community;
use GoodToKnow\Models\CommunityToTopic;
use GoodToKnow\Models\Post;
use GoodToKnow\Models\Topic;
use GoodToKnow\Models\TopicToPost;
use GoodToKnow\Models\User;

class SetHomeCommunityTopicPost
{
    public function page(int $community_id = 0, int $topic_id = 0, int $post_id = 0)
    {
        /**
         * DESCRIPTION
         * ===========
         *
         * This script runs when a user (on home page) clicks a community, a topic, or a post hyperlink.
         * It does its thing then redirects back to the home page.
         *
         * home is the route for displaying a blog resource.
         * A blog resource is either a Community, a Topic or a Post.
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

        if ($topic_id == 0) {

            $type_of_resource_requested = 'community';

            if ($post_id != 0) {

                breakout(' Your resource request is defective. (errno 1) ');

            }

        } else {

            $type_of_resource_requested = 'topic_or_post';

        }


        if ($type_of_resource_requested === 'topic_or_post') {

            if ($post_id === 0 && $topic_id !== 0) {

                $type_of_resource_requested = 'topic';

            } elseif ($post_id !== 0 && $topic_id !== 0) {

                $type_of_resource_requested = 'post';

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

        if (!array_key_exists($community_id, $g->special_community_array)) {

            breakout(' Invalid community_id. ');

        }


        // Get and store the special topic array.

        $special_topic_array = CommunityToTopic::get_topics_array_for_a_community($community_id);

        if (!$special_topic_array) {

            $special_topic_array = [];

        }

        $_SESSION['special_topic_array'] = $special_topic_array;
        $_SESSION['last_refresh_topics'] = time();


        // Breakout if the user specified topic id is non-zero and is not in $special_topic_array.

        if ($topic_id != 0 && !array_key_exists($topic_id, $special_topic_array)) {

            breakout(' Your resource request is defective.  (errno 6) ');

        }


        // Get the community object.

        $community_object = Community::find_by_id($community_id);


        // Store the community name and community description in the session.

        $_SESSION['community_name'] = $community_object->community_name;
        $_SESSION['community_description'] = $community_object->community_description;


        // Store the type of resource requested in the session.

        $_SESSION['type_of_resource_requested'] = $type_of_resource_requested;


        // Store the id of each.

        $_SESSION['community_id'] = $community_id;
        $_SESSION['topic_id'] = $topic_id;
        $_SESSION['post_id'] = $post_id;


        /**
         * This section is for these types of resources:
         *
         *      Topic, Post
         */


        // Defining $special_post_array outside any if statement to make sure it is defined.

        $special_post_array = [];

        if ($type_of_resource_requested == 'topic' or $type_of_resource_requested == 'post') {

            // Get the Topic object.

            $topic_object = Topic::find_by_id($topic_id);


            // Store the Topic name and description.

            $_SESSION['topic_name'] = $topic_object->topic_name;
            $_SESSION['topic_description'] = $topic_object->topic_description;


            // Get a fresh copy of $special_post_array.

            $special_post_array = TopicToPost::special_get_posts_array_for_a_topic($topic_id);

            if (!$special_post_array) {

                $special_post_array = [];

            }


            // Store the special post array.

            $_SESSION['special_post_array'] = $special_post_array;
            $_SESSION['last_refresh_posts'] = time();

        }


        /**
         * This section is for this type of resource:
         *
         *      Post
         */


        if ($type_of_resource_requested === 'post') {


            // Breakout if the post id is not in the special post array.

            if (!array_key_exists($post_id, $special_post_array)) {

                breakout(' Your resource request is defective.  (errno 4) ');

            }


            // Get the Post object and its content.

            $post_object = Post::find_by_id($post_id);

            if (!$post_object) {

                breakout(' SetHomeCommunityTopicPost says: Error 58498. ');

            }

            $post_content = file_get_contents($post_object->html_file);

            if ($post_content === false) {

                breakout(' Unable to read the post\'s html source file. ');

            }


            // Store the Post name in the session.

            $_SESSION['post_name'] = $post_object->title;


            // Generate a publishing date for the Post and store the Post's full name.

            $epoch_time = (int)$post_object->created;

            $publish_date = date("m/d/Y", $epoch_time);

            $_SESSION['post_full_name'] = $post_object->extensionfortitle . ' [' . $publish_date . ']';


            // Store post content and its last refresh time.

            $_SESSION['post_content'] = $post_content;

            $_SESSION['last_refresh_content'] = time();


            // Get and store author information.

            $post_author_object = User::find_by_id($post_object->user_id);

            if ($post_author_object === false) {

                breakout(' Unable to get the post author object from the database. ');

            }

            $_SESSION['author_username'] = $post_author_object->username;

            $_SESSION['author_id'] = (int)$post_author_object->id;

        }


        // Store the message in the session.

        $_SESSION['message'] = $g->message;


        // Redirect to home page.

        redirect_to("/ax1/home/page");

    }
    
}