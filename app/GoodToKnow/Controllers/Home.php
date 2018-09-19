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
        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;
        global $user_id;                    // int value
        global $role;                       // string value
        global $community_name;             // string value
        global $community_id;               // int value
        global $communities_for_this_user;  // array (key: id of community, value: name of community)
        global $topic_id;                   // int value
        global $post_id;                    // int value
        global $saved_str01;                // string value (temporary storage)
        global $saved_str02;
        global $type_of_resource_being_requested;  // result of running SetHomePageCommunityTopicPost


        /**
         * Debug
         */
        echo "\n<p>Begin debug</p><br>\n";
        echo "<p>Var_dump \$sessionMessage: </p>\n<pre>";
        var_dump($sessionMessage);
        echo "</pre><br>\n";
        echo "<p>Var_dump \$user_id: </p>\n<pre>";
        var_dump($user_id);
        echo "</pre><br>\n";
        echo "<p>Var_dump \$community_id: </p>\n<pre>";
        var_dump($community_id);
        echo "</pre><br>\n";
        echo "<p>Var_dump \$communities_for_this_user: </p>\n<pre>";
        var_dump($communities_for_this_user);
        echo "</pre><br>\n";
        echo "<p>Var_dump \$topic_id: </p>\n<pre>";
        var_dump($topic_id);
        echo "</pre><br>\n";
        echo "<p>Var_dump \$type_of_resource_being_requested: </p>\n<pre>";
        print_r($type_of_resource_being_requested);
        echo "</pre><br>\n";
        echo "<p>Var_dump \$post_id: </p>\n<pre>";
        var_dump($post_id);
        echo "</pre><br>\n";
        die("<p>End debug</p>\n");



        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/InfiniteLoopPrevent/page");
        }

        $html_title = 'GoodToKnow.io';

        require VIEWS . DIRSEP . 'home.php';
    }
}