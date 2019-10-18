<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Post;
use Michelf\MarkdownExtra;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class CreateNewPostEditProcessor
{
    function page()
    {
        /**
         * Starting off with $_SESSION['saved_int02'] which is the post id AND starting off with
         * a submitted form which gives us the markdown for the post AND $_SESSION['saved_int01'] = $chosen_topic_id;
         *
         * The task at hand is to do the same things which are done by the EditMyPost series of
         * controllers in order to use the post record from the database so that we can update the markdown and html
         * files related to it using the submitted post content as the source material.
         */

        global $sessionMessage;
        global $saved_int01;     // topic id
        global $saved_int02;     // post id
        global $community_id;

        kick_out_loggedoutusers();

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $markdown = standard_form_field_prep('markdown', 1, 38000);


        /**
         * Generate the html equivalent for $markdown.
         */

        $parser = new MarkdownExtra;
        $parser->no_entities = true;
        $html = $parser->transform($markdown);

//        $html = MarkdownExtra::defaultTransform($markdown);

//        $parsedown_object = new \ParsedownExtra();
//        $parsedown_object->setMarkupEscaped(true);
//        $parsedown_object->setSafeMode(true);
//        $html = $parsedown_object->text($markdown);


        /**
         * Get the post from the database.
         */

        $db = get_db();

        $post = Post::find_by_id($db, $sessionMessage, $saved_int02);

        if ($post === false) {

            breakout(' Could not find the post by id. ');

        }


        /**
         * Save the markdown to disc.
         * If fails then add message.
         */

        $bytes_written = file_put_contents($post->markdown_file, $markdown);

        if ($bytes_written === false) {
            breakout(' Function file_put_contents() unable to write markdown file. Mission aborted! ');
        }


        /**
         * Save the html to disc.
         * If fails then add message.
         */

        $bytes_written = file_put_contents($post->html_file, $html);

        if ($bytes_written === false) {
            breakout(' Function file_put_contents() unable to write html file. But the markdown file did get written. ');
        }


        /**
         * Declare success.
         */

        $bytes_written_text = size_as_text($bytes_written);

        $embedded_link_to_post = '<a href="/ax1/SetHomePageCommunityTopicPost/page/' . $community_id . '/' .
            $saved_int01 . '/' . $saved_int02 . '">here </a>';

        breakout(" <b>{$bytes_written_text}</b> written (max allowed 37.1 KB.) Click
         ➡️ {$embedded_link_to_post} ⬅️ to view your edited post. ");
    }
}