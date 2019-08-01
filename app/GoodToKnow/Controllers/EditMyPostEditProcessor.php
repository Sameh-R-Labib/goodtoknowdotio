<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/21/18
 * Time: 9:09 PM
 */

namespace GoodToKnow\Controllers;


class EditMyPostEditProcessor
{
    function page()
    {
        /**
         * The purpose is to validate,
         * generate html, and store the
         * edited post's markdown and
         * html files.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_str01;                // path for markdown file
        global $saved_str02;                // path for html file
        global $community_id;
        global $saved_int01;                // id of edited post's Topic
        global $saved_int02;                // id of edited post

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         * Verify that a string representing
         * the edited post was submitted.
         * $_POST['markdown']
         */
        $markdown = (isset($_POST['markdown'])) ? $_POST['markdown'] : '';
        if (!isset($_POST['markdown']) || trim($markdown) === '') {
            $sessionMessage .= " The edited file was not saved because nothing was submitted. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            redirect_to("/ax1/Home/page");
        }
        if (strlen($markdown) > 38000) {
            $sessionMessage .= " The edited file you submitted was not saved because there were too many characters. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            redirect_to("/ax1/Home/page");
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
            $sessionMessage .= " file_put_contents() unable to write markdown file. Mission aborted!";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         * Save the html to disc.
         * If fails then add message.
         */
        $bytes_written = file_put_contents($saved_str02, $html);
        if ($bytes_written === false) {
            $sessionMessage .= " file_put_contents() unable to write html file. But the markdown file did get written.";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         * Declare success.
         */
        $bytes_written_text = size_as_text($bytes_written);
        $embedded_link_to_post = '<a href="/ax1/SetHomePageCommunityTopicPost/page/' . $community_id . '/' .
            $saved_int01 . '/' . $saved_int02 . '">here </a>';
        $sessionMessage .= " <b>{$bytes_written_text}</b> written (max allowed 37.1 KB.) Click
         ➡️ {$embedded_link_to_post} ⬅️ to view your edited post. ";
        $_SESSION['message'] = $sessionMessage;
        $_SESSION['saved_int01'] = 0;
        $_SESSION['saved_int02'] = 0;
        $_SESSION['saved_str01'] = "";
        $_SESSION['saved_str02'] = "";
        redirect_to("/ax1/Home/page");
    }
}