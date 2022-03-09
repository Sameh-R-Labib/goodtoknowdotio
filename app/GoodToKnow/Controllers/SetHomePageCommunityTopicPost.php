<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Community;
use GoodToKnow\Models\CommunityToTopic;
use GoodToKnow\Models\Post;
use GoodToKnow\Models\Topic;
use GoodToKnow\Models\TopicToPost;
use GoodToKnow\Models\User;


class SetHomePageCommunityTopicPost
{
    public function page(int $community_id, int $topic_id, int $post_id)
    {
        /**
         * This script runs when a user (on Home page) clicks a community, a topic, or a post hyperlink.
         * It does its thing then redirects back to the Home page.
         *
         * "Its thing:"
         *  - Make sure the resource being requested is legitimate.
         *  - Extract related information from the database.
         *  - Save the extracted information to the SESSION.
         */


        global $g;


        /**
         * We're "jumping the gun" a little bit by making these assignments -- but it makes our code neat.
         * If these values are bad then these assignments will go poof when the script ends -- and the
         * session won't be affected.
         **/
        $g->community_id = $community_id;
        $g->topic_id = $topic_id;
        $g->post_id = $post_id;


        self::abort_if_an_anomalous_condition_exists();


        $g->db = db_connect();


        self::mostly_making_sure_chosen_community_is_ok_to_choose();


        self::conditionally_get_the_topics_and_derive_the_data_surrounding_it();


        self::conditionally_get_the_posts_array_and_derive_the_info_surrounding_it();


        self::conditionally_get_the_post_content_and_derive_the_info_surrounding_it();


        self::conditionally_store_derived_info_in_the_session();


        redirect_to("/ax1/Home/page");
    }


    private static function conditionally_store_derived_info_in_the_session()
    {
        global $g;


        // First get and store the community_name

        $g->community_object = Community::find_by_id($g->community_id);

        $_SESSION['community_name'] = $g->community_object->community_name;
        $_SESSION['community_description'] = $g->community_object->community_description;


        // Then do the rest.

        $_SESSION['special_topic_array'] = $g->special_topic_array;
        $_SESSION['last_refresh_topics'] = time();

        if ($g->type_of_resource_requested === 'topic') {
            // Second get and store the topic_name

            $g->topic_object = Topic::find_by_id($g->topic_id);

            $_SESSION['topic_name'] = $g->topic_object->topic_name;
            $_SESSION['topic_description'] = $g->topic_object->topic_description;


            // Then do the rest.

            $_SESSION['special_post_array'] = $g->special_post_array;
            $_SESSION['last_refresh_posts'] = time();

        } elseif ($g->type_of_resource_requested === 'post') {
            // Second get and store the topic_name

            $g->topic_object = Topic::find_by_id($g->topic_id);

            $_SESSION['topic_name'] = $g->topic_object->topic_name;
            $_SESSION['topic_description'] = $g->topic_object->topic_description;


            // Third store the post_name

            $_SESSION['post_name'] = $g->post_object->title;

            $epoch_time = (int)$g->post_object->created;

            $publish_date = date("m/d/Y", $epoch_time);

            $_SESSION['post_full_name'] = $g->post_object->extensionfortitle . ' [' . $publish_date . ']';


            // Then do the rest.

            $_SESSION['special_post_array'] = $g->special_post_array;
            $_SESSION['last_refresh_posts'] = time();
            $_SESSION['post_content'] = $g->post_content;
            $_SESSION['last_refresh_content'] = time();
            $_SESSION['author_username'] = $g->post_author_object->username;
            $_SESSION['author_id'] = (int)$g->post_author_object->id;
        }

        $_SESSION['type_of_resource_requested'] = $g->type_of_resource_requested;
        $_SESSION['community_id'] = $g->community_id;
        $_SESSION['topic_id'] = $g->topic_id;
        $_SESSION['post_id'] = $g->post_id;
        $_SESSION['message'] = $g->message;
    }


    private static function conditionally_get_the_post_content_and_derive_the_info_surrounding_it()
    {
        global $g;


        if ($g->type_of_resource_requested === 'post') {

            if (!array_key_exists($g->post_id, $g->special_post_array)) {

                breakout(' Your resource request is defective.  (errno 4) ');

            }


            $g->post_object = Post::find_by_id($g->post_id);

            if (!$g->post_object) {

                breakout(' SetHomePageCommunityTopicPost says: Error 58498. ');

            }


            $g->post_content = file_get_contents($g->post_object->html_file);

            if ($g->post_content === false) {

                breakout(' Unable to read the post\'s html source file. ');

            }


            $g->post_author_object = User::find_by_id($g->post_object->user_id);


            if ($g->post_author_object === false) {

                breakout(' Unable to get the post author object from the database. ');

            }
        }
    }


    private static function conditionally_get_the_posts_array_and_derive_the_info_surrounding_it()
    {
        global $g;


        /**
         * If the request is for a post then let us
         * make sure that post id is valid.
         */

        if ($g->type_of_resource_requested === 'topic_or_post') {

            // Either way we need this

            $g->special_post_array = TopicToPost::special_get_posts_array_for_a_topic($g->topic_id);

            if (!$g->special_post_array) {

                $g->special_post_array = [];

            }


            // Which is it?

            if ($g->post_id === 0 && $g->topic_id !== 0) {

                $g->type_of_resource_requested = 'topic';

            } elseif ($g->post_id !== 0 && $g->topic_id !== 0) {

                $g->type_of_resource_requested = 'post';

            } else {

                breakout(' Anomalous situation #2954. ');

            }
        }
    }


    private static function conditionally_get_the_topics_and_derive_the_data_surrounding_it()
    {
        global $g;

        /**
         * But before we get started let's establish whether or not
         * $g->topic_id is not some topic id from amongst the topics belonging to the $g->community_id
         */

        $g->special_topic_array = CommunityToTopic::get_topics_array_for_a_community($g->community_id);

        if ($g->special_topic_array && $g->topic_id != 0 && !array_key_exists($g->topic_id, $g->special_topic_array)) {

            breakout(' Your resource request is defective.  (errno 6) ');

        }

        if (!$g->special_topic_array && $g->topic_id != 0) {

            breakout(' Your resource request is defective. (errno 8) ');

        }

        if (!$g->special_topic_array) {

            $g->special_topic_array = [];

        }

        if ($g->topic_id == 0) {

            $g->type_of_resource_requested = 'community';

            if ($g->post_id != 0) {

                breakout(' Your resource request is defective. (errno 1) ');

            }

        } else {

            $g->type_of_resource_requested = 'topic_or_post';

        }
    }


    private static function mostly_making_sure_chosen_community_is_ok_to_choose()
    {
        global $g;

        if (!empty($g->message) || $g->db === false) {

            breakout(' Database connection failed. ');

        }


        /**
         * Make sure the community_id belongs to one of the user's communities.
         */

        if (!array_key_exists($g->community_id, $g->special_community_array)) {

            breakout(' Invalid community_id. ');

        }
    }


    private static function abort_if_an_anomalous_condition_exists()
    {
        global $g;

        if (!$g->is_logged_in || !empty($g->message)) {

            $_SESSION['message'] = $g->message;

            reset_feature_session_vars();

            redirect_to("/ax1/LoginForm/page");

        }
    }
}