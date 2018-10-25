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
    public function page()
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

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Verify that a string representing
         * the edited post was submitted.
         * $_POST['markdown']
         */
        $markdown = (isset($_POST['markdown'])) ? $_POST['markdown'] : '';
        $markdown = trim($markdown);
        if (!isset($_POST['markdown']) || $markdown === '') {
            $sessionMessage .= " The edited file was not saved because either the submitted form
            had no markdown field or the markdown field was empty. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        if (strlen($markdown) > 38000) {
            $sessionMessage .= " The edited file you submitted was not saved because the number of characters
            exceeded the maximum allowed for a post. ";
            $_SESSION['message'] = $sessionMessage;
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
            redirect_to("/ax1/Home/page");
        }

        /**
         * Declare success.
         */
        $_SESSION['message'] = " Your post has been updated. ";
        redirect_to("/ax1/Home/page");
    }
}