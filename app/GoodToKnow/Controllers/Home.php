<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/22/18
 * Time: 9:09 PM
 */

namespace GoodToKnow\Controllers;


class Home
{
    public function page()
    {
        global $role;                       // string value
        global $user_id;                    // int value
        global $community_id;               // int value
        global $topic_id;                   // int value
        global $post_id;                    // int value
        global $special_community_array;    // array (key: id of community, value: name of community)
        global $special_topic_array;        // array of topics for current community.
        global $special_post_array;         // array of posts for current topic
        global $post_content;               // string containing the html for current post
        global $type_of_resource_requested; // result of running SetHomePageCommunityTopicPost
        global $sessionMessage;
        global $is_logged_in;
        global $is_admin;
        global $saved_str01;                // string value (temporary storage)
        global $saved_str02;


        /**
         * Debug Code
         */
        echo "\n<p>Begin debug</p>\n";
        echo "<br><p>Var_dump \$post_content: </p>\n<pre>";
        var_dump($post_content);
        echo "</pre>\n";
        echo "<br><p>Print_r \$type_of_resource_requested: </p>\n<pre>";
        print_r($type_of_resource_requested);
        echo "</pre>\n";
        echo "<br><p>Var_dump \$_SESSION: </p>\n<pre>";
        var_dump($_SESSION);
        echo "</pre>\n";
        die("<br><p>End debug</p>\n");




        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        $html_title = 'GoodToKnow.io';

        require VIEWS . DIRSEP . 'home.php';
    }
}