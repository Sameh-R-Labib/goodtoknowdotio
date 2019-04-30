<?php


namespace GoodToKnow\Controllers;


class QuickPostDeleteProcessor
{
    public function page()
    {
        /**
         * This route:
         *  1) ascertains the topic id submitted.
         *  2) Makes sure it belongs to the user (and his current community.)
         *  3) Saves the topic id in session variable saved_int_01
         *  4) redirects to the next route.
         */
        global $special_topic_array;
        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * We should have a post variable called
         * choice whose value is the topic id for the topic
         * the admin intends to delete a post from.
         */

        $chosen_topic_id = (isset($_POST['choice'])) ? (int)$_POST['choice'] : 0;

        /**
         * Make sure $chosen_topic_id is among the ids of $special_topic_array
         */
        if (!array_key_exists($chosen_topic_id, $special_topic_array)) {
            $sessionMessage .= " Unexpected error: topic id not found in topic array. ";
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Save it in the session
         */
        $_SESSION['saved_int01'] = $chosen_topic_id;

        redirect_to("/ax1/QuickPostDeleteChoosePost/page");
    }
}