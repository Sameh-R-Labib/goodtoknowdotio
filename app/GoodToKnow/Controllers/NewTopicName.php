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
    public function page()
    {
        /**
         * The goal is to present a form
         * for entering the title of
         * the new topic.
         */
        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = "What's its name?";

        require VIEWS . DIRSEP . 'newtopicname.php';
    }
}