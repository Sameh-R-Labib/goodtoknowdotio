<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 11/2/18
 * Time: 5:17 PM
 */

namespace GoodToKnow\Controllers;


class MessageTheAuthorProcessor
{
    public function page()
    {
        /**
         * This function takes the submitted MessageTheAuthor
         * form and saves the message in the messages table.
         * It also saves a record in the message_to_user table.
         */

        global $is_logged_in;
        global $sessionMessage;

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
        if (!isset($_POST['markdown']) || trim($markdown) === '') {
            $sessionMessage .= " The message you submitted was not saved because nothing was submitted. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        if (strlen($markdown) > 1500) {
            $sessionMessage .= " The message you submitted was not saved because the number of characters
            exceeded the maximum allowed for a post. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }


    }
}