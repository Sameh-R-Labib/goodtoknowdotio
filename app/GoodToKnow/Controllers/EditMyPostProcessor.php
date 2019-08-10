<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/19/18
 * Time: 4:06 PM
 */

namespace GoodToKnow\Controllers;


use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


class EditMyPostProcessor
{
    function page()
    {
        global $special_topic_array;
        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * We should have a post variable called
         * choice whose value is the topic id
         * the user intends to create a post in
         */

        /**
         * I can't assume this post variables exist so I do the following.
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_topic_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (is_null($chosen_topic_id)) {
            $sessionMessage .= " Your choice did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

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

        redirect_to("/ax1/EditMyPostChoosePost/page");
    }
}