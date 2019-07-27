<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/12/18
 * Time: 3:16 PM
 */

namespace GoodToKnow\Controllers;


class NewTopicName
{
    function page()
    {
        /**
         * The goal is to present a form
         * for entering the title of
         * the new topic.
         */
        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $html_title = "What's its name?";

        require VIEWS . DIRSEP . 'newtopicname.php';
    }
}