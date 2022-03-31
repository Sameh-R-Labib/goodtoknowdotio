<?php

namespace GoodToKnow\Controllers;

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
        // $g->saved_int01 id of edited post's Topic
        // $g->saved_int02 id of edited post


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
        $parser->no_entities = true;
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
         * Declare success.
         */

        $bytes_written_text = size_as_text($bytes_written);

        $embedded_link_to_post = '<a href="/ax1/set_home_community_topic_post/page/' . $g->community_id . '/' .
            $g->saved_int01 . '/' . $g->saved_int02 . '">here </a>';

        breakout(" <b>{$bytes_written_text}</b> written (max allowed 57.1 KB.) Click
         ➡️ {$embedded_link_to_post} ⬅️ to view your edited post. ");
    }
}