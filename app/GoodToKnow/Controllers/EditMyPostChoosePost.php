<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/19/18
 * Time: 9:53 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\TopicToPost;

class EditMyPostChoosePost
{
    public function page()
    {
        /**
         * The goal is to present a form
         * with radio buttons for the user
         * to choose the post to edit.
         * Since users can ONLY edit posts
         * which they have created they
         * will ONLY see those.
         * We are ONLY presenting posts
         * found in the topic which was
         * already selected.
         * If we can't find any posts
         * which meet the criteria then
         * we'll store a session message
         * and redirect back home.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;        // id of topic
        global $user_id;

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        // Get all posts (as special array) for the user and topic.
        $special_post_array = TopicToPost::special_posts_array_for_user_and_topic($db, $sessionMessage, $user_id, $saved_int01);


        /**
         * Debug Code
         */
        echo "\n<p>Begin debug</p>\n";
        echo "<br><p>Var_dump \$special_post_array: </p>\n<pre>";
        var_dump($special_post_array);
        echo "</pre>\n";
        echo "<br><p>Print_r \$saved_int01: </p>\n<pre>";
        print_r($saved_int01);
        echo "</pre>\n";
        die("<br><p>End debug</p>\n");




        if (!$special_post_array) {
            $sessionMessage .= " There aren't any posts (for YOU to edit) in the topic you chose. ";
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Allow user to choose from amongst
         * the posts which remain.
         */

        $html_title = 'Which post to edit?';

        require VIEWS . DIRSEP . 'editmypostchoosepost.php';
    }
}