<?php


namespace GoodToKnow\Controllers;


class TopicDescriptionEditorProcessor
{
    function page()
    {
        /**
         * Essentially what this function will do is
         * it will process the form where the admin
         * chose the topic which he wants to edit the
         * description of. The name of the submitted
         * selection is $_POST['choice']. And its value
         * is the id of the topic selected by the admin.
         *
         * So what this function will do is:
         *  1) Validate the submission.
         *  2) Save the topic id in the session.
         *  3) Save the topic name in the session (we know what that is from the $special_topic_array.)
         *  4) Redirect to a function which will bring up the editor for the description.
         */
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $special_topic_array;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Validate the submission.
         */
        $chosen_topic_id = (isset($_POST['choice'])) ? (int)$_POST['choice'] : 0;

        // Make sure $chosen_topic_id is among the ids of $special_topic_array
        if (!array_key_exists($chosen_topic_id, $special_topic_array)) {
            $sessionMessage .= " I've encountered an unexpected error which is that the topic id was not found in topic
             array. ";
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 2) Save the topic id in the session.
         */
        $_SESSION['saved_int01'] = $chosen_topic_id;

        /**
         * 3) Save the topic name in the session (we know what that is from the $special_topic_array.)
         */
        $_SESSION['saved_str01'] = $special_topic_array[$chosen_topic_id];

        /**
         * 4) Redirect to a function which will bring up the editor for the description.
         */
        redirect_to("/ax1/TopicDescriptionEditorForm/page");
    }
}