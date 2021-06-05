<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TopicToPost;

class EditMyPostChoosePost
{
    function page()
    {
        /**
         * The goal is to present a form with radio buttons for the user
         * to choose the post to edit. Since users can ONLY edit posts
         * which they have created they will ONLY see those.
         * We are ONLY presenting posts found in the topic which was
         * already selected. If we can't find any posts which meet the
         * criteria then we'll store a session message and redirect back home.
         */

        global $gtk;
        global $db;
        // $gtk->saved_int01 id of topic


        kick_out_loggedoutusers();


        $db = get_db();


        // Get all posts (as special array) for the user and topic.

        $gtk->special_post_array = TopicToPost::special_posts_array_for_user_and_topic($gtk->user_id, $gtk->saved_int01);

        if (!$gtk->special_post_array) {

            breakout(' There are NO posts for YOU to edit here. ');

        }


        /**
         * Allow user to choose from amongst
         * the posts which remain.
         */

        $gtk->html_title = 'Which post to edit?';

        require VIEWS . DIRSEP . 'editmypostchoosepost.php';
    }
}