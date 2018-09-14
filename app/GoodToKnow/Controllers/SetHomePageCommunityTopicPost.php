<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/14/18
 * Time: 3:35 PM
 */

namespace GoodToKnow\Controllers;


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
        global $communities_for_this_user;  // array (key: id of community, value: name of community)

        if (!$is_logged_in) {
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * Make sure the three parameters were specified in the request.
         */
        if (!isset($community_id) || !isset($topic_id) || !isset($post_id)) {
            $sessionMessage .= " SetHomePageCommunityTopicPost page says: malformed request. ";
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * Make sure the community_id belongs to one of the user's communities.
         */
        if (!array_key_exists($community_id, $communities_for_this_user)) {
            $sessionMessage .= " SetHomePageCommunityTopicPost page says: invalid community_id request. ";
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * Make sure the resource being requested exists (is NOT fictitious.)
         */
        /**
         * Obviously the requested community exists since it's a
         * community the user belongs to.
         */
        /**
         * If a topic is part of the request make sure this topic exist for the community?
         */
    }
}