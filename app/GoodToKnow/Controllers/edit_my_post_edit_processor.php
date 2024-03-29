<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\changed_content;
use GoodToKnow\Models\post;
use GoodToKnow\Models\topic;
use Michelf\MarkdownExtra;
use function GoodToKnow\ControllerHelpers\markdown_form_field_prep;

class edit_my_post_edit_processor
{
    function page()
    {
        /**
         * The purpose is to validate, generate html, and store the
         * edited post's markdown and html files.
         */


        global $g;
        // $g->saved_str01 is path for markdown file
        // $g->saved_str02 path for html file
        // $g->saved_int01 id of edited post's topic
        // $g->saved_int02 id of edited post


        // We need this
        get_db();


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Verify that a string representing
         * the edited post was submitted.
         * 'markdown'
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'markdown_form_field_prep.php';

        $g->markdown = markdown_form_field_prep('markdown', 1, 58000);


        // $g->markdown = htmlspecialchars($g->markdown, ENT_NOQUOTES | ENT_HTML5, "UTF-8");
        // I commented out because parsedown will take care of this.


        /**
         * Generate the html equivalent for $g->markdown.
         */

        $parser = new MarkdownExtra;
        $parser->no_entities = true; // So, & stays as & instead of &amp;
        $html = $parser->transform($g->markdown);

        // Call to global function
        fix_michelf($html);

//        $html = MarkdownExtra::defaultTransform($g->markdown);

//        $parsedown_object = new \ParsedownExtra();
//        $parsedown_object->setMarkupEscaped(true);
//        $parsedown_object->setSafeMode(true);
//        $html = $parsedown_object->text($g->markdown);


        /**
         * Save the markdown to disc.
         * If fails then add message.
         */

        $bytes_written = file_put_contents($g->saved_str01, $g->markdown);

        if ($bytes_written === false) {

            breakout(' Function file_put_contents() unable to write markdown file. Mission aborted! ');

        }


        /**
         * Save the html to disc.
         * If fails then add message.
         */

        $bytes_written = file_put_contents($g->saved_str02, $html);

        if ($bytes_written === false) {

            breakout(' Function file_put_contents() unable to write html file. But the markdown file did get written. ');

        }


        /**
         * Here, create and save a new changed_content.
         * This changed_content object creates a historical record of the fact that a
         * post was edited. This is part of a system which enables the administrator
         * to monitor new content.
         *
         * First, I will make sure I have all the pieces of information needed to build
         * the changed_content object.
         */

        // id <-- will be generated automatically.

        // time <-- time()

        // name <-- actually what's important is its components (which are described directly below.)

        // name component: community name <-- $g->community_name

        // name component: topic name <-- I'll need to derive that based on $g->saved_int01
        //                                $topic_object->topic_name

        $topic_object = topic::find_by_id($g->saved_int01);

        if (!$topic_object) {

            breakout(' I was unexpectedly unable to retrieve the topic\'s object. ');

        }


        // name component: post name <-- THERE IS A PROBLEM HERE: WE DON'T HAVE THE TITLE OF THE POST
        // So we get the post object, so we can use its 'title'.

        $post = post::find_by_id($g->saved_int02);

        if ($post === false) {

            breakout(' Could not find the post by id. ');

        }

        $name = $g->community_name . ' → ' . $topic_object->topic_name . ' → ' . $post->title;

        // type <-- 'blog_post'

        // post_id <-- $g->saved_int02

        // expires <-- time() + 3024000  (that is 35 days away from now.)

        $changed_content_array = ['time' => time(), 'name' => $name, 'type' => 'blog_post', 'post_id' => $g->saved_int02,
            'expires' => time() + 3024000, 'community_id' => $g->community_id, 'topic_id' => $g->saved_int01,
            'author_username' => $g->user_username];

        $changed_content_object = changed_content::array_to_object($changed_content_array);

        $result = $changed_content_object->save();

        if (!$result) {

            breakout(' Unexpected I was unable to save the new changed_content object. ');

        }


        /**
         * Declare success.
         */

        $bytes_written_text = size_as_text($bytes_written);

        $embedded_link_to_post = '<a href="/ax1/set_home_community_topic_post/page/' . $g->community_id . '/' .
            $g->saved_int01 . '/' . $g->saved_int02 . '">here </a>';

        breakout(" <b>$bytes_written_text</b> written (max allowed 57.1 KB.) Click
         ➡️ $embedded_link_to_post ⬅️ to view your edited post. ");
    }
}