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

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
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
            redirect_to("/ax1/Home/page");
        }
        if (strlen($markdown) > 38000) {
            $sessionMessage .= " The edited file you submitted was not saved because there were too many characters. ";
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
        $bytes_written_text = size_as_text($bytes_written);
        $_SESSION['message'] = " Written {$bytes_written_text} out of max 37.1 KB. Stay well within limit. ";
        redirect_to("/ax1/Home/page");
    }
}