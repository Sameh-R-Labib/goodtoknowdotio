<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\community;
use GoodToKnow\Models\community_to_topic;
use GoodToKnow\Models\topic;
use GoodToKnow\Models\topic_to_post;
use GoodToKnow\Models\user;

class transfer_post_ownership_get_post
{
    function page(int $id = 0)
    {
        /**
         * This route will (1) determine which post the Admin chose to do a transfer of ownership to,
         * (2) stores the post's id in the session, and
         * (3) presents a form asking the user if he
         * is sure this is the post he wants to transfer the ownership of.
         *
         * For step (3):
         * Based on the submitted post id the script will derive and present:
         *  - community name
         *  - topic name
         *  - Blog Post title | extensionfortitle
         *  - Author username
         */


        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        get_db();


        $g->id = $id;


        require CONTROLLERINCLUDES . DIRSEP . 'admin_get_post.php';


        // (2) stores the post's id in the session

        $_SESSION['saved_int02'] = $g->id;


        // (3) presents a form asking the user if he is sure this is the post he wants to transfer the ownership of.

        $g->long_title_of_post = $g->post_object->title . " | " . $g->post_object->extensionfortitle;


        // Find the community name based on the post id. First derive the topic id from the post id.
        // Blog Post id is $g->id

        $derived_topic_id = topic_to_post::derive_topic_id($g->id);

        if ($derived_topic_id === false) {

            breakout(' transfer_post_ownership_get_post::page() says: Failed to get the topic id. ');

        }


        // Second derive the community id from $derived_topic_id.

        $derived_community_id = community_to_topic::derive_community_id($derived_topic_id);

        if ($derived_community_id === false) {

            breakout(' transfer_post_ownership_get_post::page() says: Failed to get the community id. ');

        }


        // Third find the community name based on the community id.

        $community_object = community::find_by_id($derived_community_id);

        if ($community_object === false) {

            breakout(' transfer_post_ownership_get_post::page() says: Failed to get the community object. ');

        }

        $g->community_name = $community_object->community_name;


        // Find the topic name based on $derived_topic_id

        $topic_object = topic::find_by_id($derived_topic_id);

        if ($topic_object === false) {

            breakout(' transfer_post_ownership_get_post::page() says: Failed to get the topic object. ');

        }

        $g->topic_name = $topic_object->topic_name;


        // Find the author's username.

        $user_object = user::find_by_id($g->post_object->user_id);

        if ($user_object === false) {

            breakout(' transfer_post_ownership_get_post::page() says: Failed to get the user object. ');

        }

        $g->author_username = $user_object->username;


        // Present the view

        $g->html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'transferpostownershipgetpost.php';
    }
}