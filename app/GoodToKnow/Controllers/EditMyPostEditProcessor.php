<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class EditMyPostEditProcessor
{
    function page()
    {
        /**
         * The purpose is to validate, generate html, and store the
         * edited post's markdown and html files.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_str01;                // path for markdown file
        global $saved_str02;                // path for html file
        global $community_id;
        global $saved_int01;                // id of edited post's Topic
        global $saved_int02;                // id of edited post

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }


        /**
         * Verify that a string representing
         * the edited post was submitted.
         * $_POST['markdown']
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $markdown = standard_form_field_prep('markdown', 1, 38000);

        if (is_null($markdown)) {
            breakout(' The markdown did not pass validation. ');
        }


        // $markdown = htmlspecialchars($markdown, ENT_NOQUOTES | ENT_HTML5, "UTF-8");
        // I commented out because parsedown will take care of this.


        /**
         * Generate the html equivalent for $markdown.
         */

        $parsedown_object = new \ParsedownExtra();
        $parsedown_object->setMarkupEscaped(true);
        $parsedown_object->setSafeMode(true);
        $html = $parsedown_object->text($markdown);


        /**
         * Save the markdown to disc.
         * If fails then add message.
         */

        $bytes_written = file_put_contents($saved_str01, $markdown);

        if ($bytes_written === false) {
            breakout(' Function file_put_contents() unable to write markdown file. Mission aborted! ');
        }


        /**
         * Save the html to disc.
         * If fails then add message.
         */

        $bytes_written = file_put_contents($saved_str02, $html);

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