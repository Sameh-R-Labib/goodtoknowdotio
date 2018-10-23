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
        $topic_description = (isset($_POST['topic_description'])) ? $_POST['topic_description'] : '';

        $topic_name = trim($topic_name);
        $topic_description = trim($topic_description);

        if (empty($topic_name) || empty($topic_description)) {
            $sessionMessage .= " Either you did not fill out the input fields or the session expired. Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $topic_name = htmlentities($topic_name, ENT_NOQUOTES | ENT_HTML5);
        $topic_description = htmlentities($topic_description, ENT_NOQUOTES | ENT_HTML5);

        if (strlen($topic_name) > 200 || strlen($topic_description) > 230) {
            $sessionMessage .= " Either your topic name or description was too long. Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_str01'] = $topic_name;
        $_SESSION['saved_str02'] = $topic_description;

        redirect_to("/ax1/NewTopicSave/page");
    }
}