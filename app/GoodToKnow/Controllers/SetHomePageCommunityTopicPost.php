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


        global $db;


        self::abort_if_an_anomalous_condition_exists();

        $db = db_connect();

        self::mostly_making_sure_chosen_community_is_ok_to_choose($community_id);

        self::get_the_topics_and_derive_the_data_surrounding_it($community_id, $post_id, $topic_id);

        self::conditionally_get_the_posts_array_and_derive_the_info_surrounding_it($topic_id, $post_id);

        $post_object = null;
        $post_author_object = null;

        self::conditionally_get_the_post_content_and_derive_the_info_surrounding_it($post_id, $post_object, $post_author_object);

        self::store_derived_info_in_the_session($community_id, $topic_id, $post_object, $post_author_object, $post_id);

        redirect_to("/ax1/Home/page");
    }

    /**
     * @param $community_id
     * @param $topic_id
     * @param $post_object
     * @param $post_author_object
     * @param $post_id
     */
    private static function store_derived_info_in_the_session($community_id, $topic_id,
                                                              $post_object, $post_author_object, $post_id)
    {
        global $app_state;
        global $community_object;
        global $topic_object;


        // First get and store the community_name

        $community_object = Community::find_by_id($community_id);

        $_SESSION['community_name'] = $community_object->community_name;
        $_SESSION['community_description'] = $community_object->community_description;


        // Then do the rest.

        $_SESSION['special_topic_array'] = $app_state->special_topic_array;
        $_SESSION['last_refresh_topics'] = time();

        if ($app_state->type_of_resource_requested === 'topic') {
            // Second get and store the topic_name

            $topic_object = Topic::find_by_id($topic_id);

            $_SESSION['topic_name'] = $topic_object->topic_name;
            $_SESSION['topic_description'] = $topic_object->topic_description;


            // Then do the rest.

            $_SESSION['special_post_array'] = $app_state->special_post_array;
            $_SESSION['last_refresh_posts'] = time();

        } elseif ($app_state->type_of_resource_requested === 'post') {
            // Second get and store the topic_name

            $topic_object = Topic::find_by_id($topic_id);

            $_SESSION['topic_name'] = $topic_object->topic_name;
            $_SESSION['topic_description'] = $topic_object->topic_description;


            // Third store the post_name

            $_SESSION['post_name'] = $post_object->title;

            $epoch_time = (int)$post_object->created;

            $publish_date = date("m/d/Y T", $epoch_time);

            $_SESSION['post_full_name'] = $post_object->extensionfortitle . ' [' .
                $publish_date . ']';


            // Then do the rest.

            $_SESSION['special_post_array'] = $app_state->special_post_array;
            $_SESSION['last_refresh_posts'] = time();
            $_SESSION['post_content'] = $app_state->post_content;
            $_SESSION['last_refresh_content'] = time();
            $_SESSION['author_username'] = $post_author_object->username;
            $_SESSION['author_id'] = (int)$post_author_object->id;
        }

        $_SESSION['type_of_resource_requested'] = $app_state->type_of_resource_requested;
        $_SESSION['community_id'] = $community_id;
        $_SESSION['topic_id'] = $topic_id;
        $_SESSION['post_id'] = $post_id;
        $_SESSION['message'] = $app_state->message;
    }


    /**
     * @param $post_id
     * @param $post_object
     * @param $post_author_object
     */
    private static function conditionally_get_the_post_content_and_derive_the_info_surrounding_it($post_id, &$post_object,
                                                                                                  &$post_author_object)
    {
        global $app_state;


        if ($app_state->type_of_resource_requested === 'post') {

            if (!array_key_exists($post_id, $app_state->special_post_array)) {

                breakout(' Your resource request is defective.  (errno 4) ');

            }


            $post_object = Post::find_by_id($post_id);

            if (!$post_object) {

                breakout(' SetHomePageCommunityTopicPost says: Error 58498. ');

            }


            $app_state->post_content = file_get_contents($post_object->html_file);

            if ($app_state->post_content === false) {

                breakout(' Unable to read the post\'s html source file. ');

            }


            $post_author_object = User::find_by_id($post_object->user_id);


            if ($post_author_object === false) {

                breakout(' Unable to get the post author object from the database. ');

            }
        }
    }


    /**
     * @param $topic_id
     * @param $post_id
     */
    private static function conditionally_get_the_posts_array_and_derive_the_info_surrounding_it($topic_id, $post_id)
    {
        global $app_state;


        /**
         * If the request is for a post then let us
         * make sure that post id is valid.
         */

        if ($app_state->type_of_resource_requested === 'topic_or_post') {

            // Either way we need this

            $app_state->special_post_array = TopicToPost::special_get_posts_array_for_a_topic($topic_id);

            if (!$app_state->special_post_array) {

                $app_state->special_post_array = [];

            }


            // Which is it?

            if ($post_id === 0 && $topic_id !== 0) {

                $app_state->type_of_resource_requested = 'topic';

            } elseif ($post_id !== 0 && $topic_id !== 0) {

                $app_state->type_of_resource_requested = 'post';

            } else {

                breakout(' Anomalous situation #2954. ');

            }
        }
    }


    /**
     * @param $community_id
     * @param $post_id
     * @param $topic_id
     */
    private static function get_the_topics_and_derive_the_data_surrounding_it($community_id, $post_id, $topic_id)
    {
        global $app_state;

        /**
         * But before we get started let's establish whether or not
         * $topic_id is not some topic id from amongst the topics belonging to the $community_id
         */

        $app_state->special_topic_array = CommunityToTopic::get_topics_array_for_a_community($community_id);

        if ($app_state->special_topic_array && $topic_id != 0 && !array_key_exists($topic_id, $app_state->special_topic_array)) {

            breakout(' Your resource request is defective.  (errno 6) ');

        }

        if (!$app_state->special_topic_array && $topic_id != 0) {

            breakout(' Your resource request is defective. (errno 8) ');

        }

        if (!$app_state->special_topic_array) {

            $app_state->special_topic_array = [];

        }

        if ($topic_id == 0) {

            $app_state->type_of_resource_requested = 'community';

            if ($post_id != 0) {

                breakout(' Your resource request is defective. (errno 1) ');

            }

        } else {

            $app_state->type_of_resource_requested = 'topic_or_post';

        }
    }


    /**
     * @param $community_id
     */
    private static function mostly_making_sure_chosen_community_is_ok_to_choose($community_id)
    {
        global $db;
        global $app_state;

        if (!empty($app_state->message) || $db === false) {

            breakout(' Database connection failed. ');

        }


        /**
         * Make sure the community_id belongs to one of the user's communities.
         */

        if (!array_key_exists($community_id, $app_state->special_community_array)) {

            breakout(' Invalid community_id. ');

        }
    }


    /**
     */
    private static function abort_if_an_anomalous_condition_exists()
    {
        global $app_state;

        if (!$app_state->is_logged_in || !empty($app_state->message)) {

            $_SESSION['message'] = $app_state->message;

            reset_feature_session_vars();

            redirect_to("/ax1/LoginForm/page");

        }
    }
}