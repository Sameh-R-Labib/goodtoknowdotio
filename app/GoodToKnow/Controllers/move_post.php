<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\topic_to_post;

class move_post
{
    function page()
    {
        /**
         * This route starts the "Move a Post" feature.
         *
         * Q: What is the "Move a Post" feature?
         * A: - The "Move a Post" feature is an Admin tool.
         *    - It enables Admin to select a post from his current topic.
         *    - Q: What is 'his current topic'?
         *      A: 'his current topic' is the topic specified in his session variable topic_id.
         *         When he last navigated to a topic or a post then topic_id got set .
         *    - Then, Admin assigns a new topic to the post. In essence this moves the post from
         *      his current topic to the topic he selected.
         *    - If he wants to move a post which is not in his current topic then he needs to navigate
         *      to that other topic before running this feature.
         *
         * Q: More specifically, what should this route do?
         * A: This route will:
         *    - use $g->topic_id
         *    - get an array of all the posts within the topic
         *    - present a form for choosing a post
         */


        global $g;


        kick_out_nonadmins();


        // $g->topic_id is the id of the topic in which the post exists


        get_db();


        $g->array_of_post_objects = topic_to_post::get_posts_array_for_a_topic($g->topic_id);

        if (!$g->array_of_post_objects) {

            breakout(' There are no posts in your current topic. ');

        }


        $g->html_title = 'Which post is to be moved?';


        require VIEWS . DIRSEP . 'movepost.php';
    }
}