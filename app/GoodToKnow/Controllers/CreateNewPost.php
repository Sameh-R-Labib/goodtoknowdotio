<?php

namespace GoodToKnow\Controllers;

class CreateNewPost
{
    function page()
    {
        /**
         * This is the first of a series of routes aimed at creating a new post.
         *
         * The first task is that of presenting a form for getting the user to tell us
         * which topic the post belongs in.
         */


        /**
         * Debug Code
         */
        global $topic_id;
        echo "\n<p>Begin debug</p>\n";
        echo "<p>Var_dump \$topic_id: </p>\n<pre>";
        var_dump($topic_id);
        echo "</pre>\n";
        die("<p>End debug</p>\n");



        require CONTROLLERINCLUDES . DIRSEP . 'get_topics_for_a_community.php';

        require VIEWS . DIRSEP . 'createnewpost.php';
    }
}