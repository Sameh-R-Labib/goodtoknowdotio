<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/14/18
 * Time: 3:35 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\CommunityToTopic;
use GoodToKnow\Models\TopicToPost;


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
         *  - Make sure the three parameters were specified in the request.
         *  - Make sure the community_id belongs to one of the user's communities.
         *  - Make sure the resource being requested exists (is NOT fictitious.)
         *  - Set session variables which let the home page know which
         *    community, topic, or post the user desires to see.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $special_community_array;  // array (key: id of community, value: name of community)
        global $special_topic_array;
        global $special_post_array;
        global $post_content;

        if (!$is_logged_in) {
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Make sure the three parameters were specified in the request.
         *
         * Actually it would cause Fatal Error if any of the parameters was not set
         *
         * Also, there's no need to check to see if the params are numeric.
         */

        /**
         * Make sure the community_id belongs to one of the user's communities.
         */
        if (!array_key_exists($community_id, $special_community_array)) {
            $sessionMessage .= " Invalid community_id. ";
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        // Make sure the resource request is well formed and reasonable

        /**
         * Obviously the requested community exists since it's a
         * community the user belongs to.
         *
         * At this point we don't know if the user is requesting
         * a community, a topic, or a post. If the user requested
         * a community then $topic_id and $post_id must each be zero (0)
         */
        /**
         * At this point we know the user specified a valid $community_id.
         * We know that $topic_id is set. It SHOULD BE set to 0 or some
         * topic id form amongst the topics belonging to the $community_id.
         *
         * Let us make sure.
         */

        /**
         * But before we get started let's establish whether or not
         * $topic_id is not some topic id from amongst the topics belonging to the $community_id
         */
        $special_topic_array = CommunityToTopic::get_topics_array_for_a_community($db, $sessionMessage, $community_id);
        if (!$special_topic_array) {
            $sessionMessage .= " I did'nt switch communities because we don't have any topics in the community you asked for. ";
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if ($topic_id != 0 && !array_key_exists($topic_id, $special_topic_array)) {
            $sessionMessage .= " Your resource request is defective.  (errno 6)";
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if ($topic_id == 0) {
            $type_of_resource_requested = 'community';
            if ($post_id != 0) {
                $sessionMessage .= " Your resource request is defective. (errno 1)";
                $_SESSION['message'] .= $sessionMessage;
                redirect_to("/ax1/Home/page");
            }
        } else {
            $type_of_resource_requested = 'topic_or_post';
        }


        /**
         * At this point we know we have a $community_id which is valid.
         * We know whether or not the request is for a community.
         * We know whether or not the request is for topic_or_post
         * we know that $topic_id is valid
         * We know that $post_id is set. It SHOULD BE set to 0 or some
         * post id from amongst the posts belonging to $topic_id.
         *
         * If the request is for a post then let us
         * make sure that post id is valid.
         */


        if ($type_of_resource_requested === 'topic_or_post') {
            // Either way we need this
            $special_post_array = TopicToPost::special_get_posts_array_for_a_topic($db, $sessionMessage, $topic_id);
            if (!$special_post_array) {
                $sessionMessage .= " Unable to get posts for the specified topic. ";
                $_SESSION['message'] .= $sessionMessage;
                redirect_to("/ax1/Home/page");
            }
            // Which is it?
            if ($post_id === 0 && $topic_id !== 0) {
                $type_of_resource_requested = 'topic';
            } elseif ($post_id !== 0 && $topic_id !== 0) {
                $type_of_resource_requested = 'post';
            } else {
                $sessionMessage .= " Anomalous situation #2954. ";
                $_SESSION['message'] .= $sessionMessage;
                redirect_to("/ax1/Home/page");
            }
        }

        if ($type_of_resource_requested === 'post') {
            if (!array_key_exists($post_id, $special_post_array)) {
                $sessionMessage .= " Your resource request is defective.  (errno 4)";
                $_SESSION['message'] .= $sessionMessage;
                redirect_to("/ax1/Home/page");
            }

            /**
             * Later on I need to make sure the file content exist and retrieve it.
             */
            $post_content = '';
        }

        /**
         * At this point we know that the request is valid and
         * we know which type of request it is.
         *
         * Now we need to store some things in the session and redirect.
         */
        if ($type_of_resource_requested === 'community') {
            $_SESSION['special_topic_array'] = $special_topic_array;
        } elseif ($type_of_resource_requested === 'topic') {
            $_SESSION['special_topic_array'] = $special_topic_array;
            $_SESSION['special_post_array'] = $special_post_array;
        } else {
            $_SESSION['special_topic_array'] = $special_topic_array;
            $_SESSION['special_post_array'] = $special_post_array;
            $_SESSION['post_content'] = $post_content;
        }
        $_SESSION['type_of_resource_requested'] = $type_of_resource_requested;
        $_SESSION['community_id'] = $community_id;
        $_SESSION['topic_id'] = $topic_id;
        $_SESSION['post_id'] = $post_id;
        $_SESSION['message'] .= $sessionMessage;
        redirect_to("/ax1/Home/page");
    }
}