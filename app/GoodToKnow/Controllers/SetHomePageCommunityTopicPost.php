<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/14/18
 * Time: 3:35 PM
 */

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
         * This script runs when a user (on Home page) clicks a community,
         * a topic, or a post hyperlink. It does its thing then redirects
         * back to the Home page.
         *
         * "Its thing:"
         *  - Make sure the resource being requested is legitimate.
         *  - Extract related information from the database.
         *  - Save the extracted information to the SESSION.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $special_community_array;  // array (key: id of community, value: name of community)
        global $special_topic_array;
        global $special_post_array;
        global $post_content;
        global $type_of_resource_requested;

        self::abort_if_an_anomalous_condition_exists($sessionMessage, $is_logged_in);

        $db = db_connect($sessionMessage);

        self::mostly_making_sure_chosen_community_is_ok_to_choose($db, $sessionMessage, $community_id,
            $special_community_array);

        self::get_the_topics_and_derive_the_data_surrounding_it($db, $sessionMessage, $community_id, $special_topic_array,
            $post_id, $topic_id, $type_of_resource_requested);

        self::conditionally_get_the_posts_array_and_derive_the_info_surrounding_it($db, $sessionMessage,
            $type_of_resource_requested, $topic_id, $post_id, $special_post_array);

        $post_object = null;
        $post_author_object = null;
        $community_object = null;
        $topic_object = null;

        self::conditionally_get_the_post_content_and_derive_the_info_surrounding_it($db, $sessionMessage,
            $type_of_resource_requested, $special_post_array, $post_id, $post_object, $post_content,
            $post_author_object);

        self::store_derived_info_in_the_session($db, $sessionMessage, $community_object, $community_id,
            $special_topic_array, $topic_id, $topic_object, $special_post_array, $post_object, $post_content,
            $post_author_object, $post_id, $type_of_resource_requested);

        redirect_to("/ax1/Home/page");
    }

    /**
     * @param $db
     * @param $sessionMessage
     * @param $community_object
     * @param $community_id
     * @param $special_topic_array
     * @param $topic_id
     * @param $topic_object
     * @param $special_post_array
     * @param $post_object
     * @param $post_content
     * @param $post_author_object
     * @param $post_id
     * @param $type_of_resource_requested
     */
    private static function store_derived_info_in_the_session(&$db, &$sessionMessage, &$community_object, &$community_id,
                                                              &$special_topic_array, &$topic_id, &$topic_object,
                                                              &$special_post_array, &$post_object, &$post_content,
                                                              &$post_author_object, &$post_id, &$type_of_resource_requested)
    {
        // First get and store the community_name
        $community_object = Community::find_by_id($db, $sessionMessage, $community_id);

        $_SESSION['community_name'] = $community_object->community_name;
        $_SESSION['community_description'] = $community_object->community_description;

        // Then do the rest.
        $_SESSION['special_topic_array'] = $special_topic_array;
        $_SESSION['last_refresh_topics'] = time();

        if ($type_of_resource_requested === 'topic') {
            // Second get and store the topic_name
            $topic_object = Topic::find_by_id($db, $sessionMessage, $topic_id);

            $_SESSION['topic_name'] = $topic_object->topic_name;
            $_SESSION['topic_description'] = $topic_object->topic_description;

            // Then do the rest.
            $_SESSION['special_post_array'] = $special_post_array;
            $_SESSION['last_refresh_posts'] = time();
        } else {
            // Second get and store the topic_name
            $topic_object = Topic::find_by_id($db, $sessionMessage, $topic_id);

            $_SESSION['topic_name'] = $topic_object->topic_name;
            $_SESSION['topic_description'] = $topic_object->topic_description;

            // Third store the post_name
            $_SESSION['post_name'] = $post_object->title;

            $epoch_time = (int)$post_object->created;

            $publish_date = date("m/d/Y", $epoch_time);

            $_SESSION['post_full_name'] = '"' . $post_object->title . ' | ' . $post_object->extensionfortitle . '" ⏰ [Pub. ' .
                $publish_date . ' NY time] 🎬';

            // Then do the rest.
            $_SESSION['special_post_array'] = $special_post_array;
            $_SESSION['last_refresh_posts'] = time();
            $_SESSION['post_content'] = $post_content;
            $_SESSION['last_refresh_content'] = time();
            $_SESSION['author_username'] = $post_author_object->username;
            $_SESSION['author_id'] = (int)$post_author_object->id;
        }

        $_SESSION['type_of_resource_requested'] = $type_of_resource_requested;
        $_SESSION['community_id'] = $community_id;
        $_SESSION['topic_id'] = $topic_id;
        $_SESSION['post_id'] = $post_id;
        $_SESSION['message'] = $sessionMessage;
    }

    /**
     * @param $db
     * @param $sessionMessage
     * @param $type_of_resource_requested
     * @param $special_post_array
     * @param $post_id
     * @param $post_object
     * @param $post_content
     * @param $post_author_object
     */
    private static function conditionally_get_the_post_content_and_derive_the_info_surrounding_it(&$db, &$sessionMessage,
                                                                                                  &$type_of_resource_requested,
                                                                                                  &$special_post_array,
                                                                                                  &$post_id, &$post_object,
                                                                                                  &$post_content,
                                                                                                  &$post_author_object)
    {
        if ($type_of_resource_requested === 'post') {

            if (!array_key_exists($post_id, $special_post_array)) {
                $sessionMessage = " Your resource request is defective.  (errno 4)";
                $_SESSION['message'] = $sessionMessage;
                reset_feature_session_vars();
                redirect_to("/ax1/Home/page");
            }

            $post_object = Post::find_by_id($db, $sessionMessage, $post_id);

            if (!$post_object) {
                $sessionMessage .= " SetHomePageCommunityTopicPost::page says: Error 58498. ";
                $_SESSION['message'] = $sessionMessage;
                reset_feature_session_vars();
                redirect_to("/ax1/Home/page");
            }

            $post_content = file_get_contents($post_object->html_file);

            if ($post_content === false) {
                $sessionMessage .= " Unable to read the post's html source file. ";
                $_SESSION['message'] = $sessionMessage;
                reset_feature_session_vars();
                redirect_to("/ax1/Home/page");
            }

            $post_author_object = User::find_by_id($db, $sessionMessage, $post_object->user_id);

            if ($post_author_object === false) {
                $sessionMessage .= " Unable to get the post author object from the database. ";
                $_SESSION['message'] = $sessionMessage;
                reset_feature_session_vars();
                redirect_to("/ax1/Home/page");
            }
        }
    }

    /**
     * @param $db
     * @param $sessionMessage
     * @param $type_of_resource_requested
     * @param $topic_id
     * @param $post_id
     * @param $special_post_array
     */
    private static function conditionally_get_the_posts_array_and_derive_the_info_surrounding_it(&$db, &$sessionMessage,
                                                                                                 &$type_of_resource_requested,
                                                                                                 &$topic_id, &$post_id,
                                                                                                 &$special_post_array)
    {
        /**
         * If the request is for a post then let us
         * make sure that post id is valid.
         */

        if ($type_of_resource_requested === 'topic_or_post') {

            // Either way we need this
            $special_post_array = TopicToPost::special_get_posts_array_for_a_topic($db, $sessionMessage, $topic_id);

            if (!$special_post_array) {
                $special_post_array = [];
            }

            // Which is it?
            if ($post_id === 0 && $topic_id !== 0) {

                $type_of_resource_requested = 'topic';

            } elseif ($post_id !== 0 && $topic_id !== 0) {

                $type_of_resource_requested = 'post';

            } else {
                $sessionMessage .= " Anomalous situation #2954. ";
                $_SESSION['message'] = $sessionMessage;
                reset_feature_session_vars();
                redirect_to("/ax1/Home/page");
            }
        }
    }

    /**
     * @param $db
     * @param $sessionMessage
     * @param $community_id
     * @param $special_topic_array
     * @param $post_id
     * @param $topic_id
     * @param $type_of_resource_requested
     */
    private static function get_the_topics_and_derive_the_data_surrounding_it(&$db, &$sessionMessage, &$community_id,
                                                                              &$special_topic_array, &$post_id,
                                                                              &$topic_id, &$type_of_resource_requested)
    {
        /**
         * But before we get started let's establish whether or not
         * $topic_id is not some topic id from amongst the topics belonging to the $community_id
         */
        $special_topic_array = CommunityToTopic::get_topics_array_for_a_community($db, $sessionMessage, $community_id);

        if ($special_topic_array && $topic_id != 0 && !array_key_exists($topic_id, $special_topic_array)) {
            $sessionMessage .= " Your resource request is defective.  (errno 6)";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        if (!$special_topic_array && $topic_id != 0) {
            $sessionMessage .= " Your resource request is defective. (errno 8) ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        if (!$special_topic_array) {
            $special_topic_array = [];
        }

        if ($topic_id == 0) {
            $type_of_resource_requested = 'community';

            if ($post_id != 0) {
                $sessionMessage .= " Your resource request is defective. (errno 1)";
                $_SESSION['message'] = $sessionMessage;
                redirect_to("/ax1/Home/page");
            }
        } else {
            $type_of_resource_requested = 'topic_or_post';
        }
    }

    /**
     * @param $db
     * @param $sessionMessage
     * @param $community_id
     * @param $special_community_array
     */
    private static function mostly_making_sure_chosen_community_is_ok_to_choose(&$db, &$sessionMessage, &$community_id,
                                                                                &$special_community_array)
    {
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        /**
         * Make sure the community_id belongs to one of the user's communities.
         */
        if (!array_key_exists($community_id, $special_community_array)) {
            $sessionMessage .= " Invalid community_id. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }
    }

    /**
     * @param $sessionMessage
     * @param $is_logged_in
     */
    private static function abort_if_an_anomalous_condition_exists(&$sessionMessage, &$is_logged_in)
    {
        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/LoginForm/page");
        }
    }
}