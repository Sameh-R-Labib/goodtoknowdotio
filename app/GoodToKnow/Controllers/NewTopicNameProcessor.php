<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/12/18
 * Time: 3:50 PM
 */

namespace GoodToKnow\Controllers;


class NewTopicNameProcessor
{
    public function page()
    {
        /**
         * Mission:
         *   - Receive post data for topic_name
         *   - validate
         *   - Replace html tags with html entities
         *   - Add to session
         *   - Redirect to route for saving the new post
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * I can't assume these post variables exist so I do the following.
         */
        $topic_name = (isset($_POST['topic_name'])) ? $_POST['topic_name'] : '';

        $topic_name = trim($topic_name);

        if (empty($topic_name)) {
            $sessionMessage .= " Either you did not fill out the input field or the session expired. Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (strlen($topic_name) > 200) {
            $sessionMessage .= " The topic name you specified was too long (max 200 bytes.) Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $topic_name = htmlentities($topic_name, ENT_QUOTES);

        $_SESSION['saved_str01'] = $topic_name;

        redirect_to("/ax1/NewTopicSave/page");
    }
}