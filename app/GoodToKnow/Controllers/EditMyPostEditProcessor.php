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

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage)) {
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
        if (strlen($markdown) > 8000) {
            $sessionMessage .= " The edited file you submitted was not saved because the number of characters
            exceeded the maximum allowed for a post. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Generate the html equivalent for $markdown.
         */
        $html = "The result of converting the markdown to html.";

        /**
         * Save the markdown to disc.
         * If fails then add message.
         */

        /**
         * Save the html to disc.
         * If fails then add message.
         */

        /**
         * If there's a message then abort.
         */
        if (!empty($sessionMessage)) {
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