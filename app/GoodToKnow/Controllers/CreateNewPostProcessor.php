<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/29/18
 * Time: 4:43 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\TopicToPost;


class CreateNewPostProcessor
{
    public function page()
    {
        global $special_topic_array;
        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * We should have a post variable called
         * choice whose value is the topic id
         * the user intends to create a post in
         */

        /**
         * I can't assume this post variables exist so I do the following.
         */
        $chosen_topic_id = (isset($_POST['choice'])) ? $_POST['choice'] : 0;

        /**
         * Make sure $chosen_topic_id is among the ids of $special_topic_array
         */
        if (!array_key_exists($chosen_topic_id, $special_topic_array)) {
            $sessionMessage .= " Unexpected error: topic id not found in topic array. ";
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Save it in the session
         */
        $_SESSION['saved_int01'] = (int)$chosen_topic_id;

        /**
         * Redirect
         *
         * Where we redirect depends on whether or not
         * there is more than one post in the chosen topic.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        $posts = TopicToPost::get_posts_array_for_a_topic($db, $sessionMessage, $chosen_topic_id);
        $count = count($posts);


        /**
         * Debug Code
         */
        echo "\n<p>Begin debug</p>\n";
        echo "<br><p>Var_dump \$posts: </p>\n<pre>";
        var_dump($posts);
        echo "</pre>\n";
        echo "<br><p>Print_r \$count: </p>\n<pre>";
        print_r($count);
        echo "</pre>\n";
        die("<br><p>End debug</p>\n");



        if ($count > 0) {
            redirect_to("/ax1/CreateNewPostInsertPoint/page");
        } else {
            $_SESSION['$saved_int02'] = 500000;
            redirect_to("/ax1/CreateNewPostTitle/page");
        }
    }
}