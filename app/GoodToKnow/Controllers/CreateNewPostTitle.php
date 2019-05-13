<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/4/18
 * Time: 5:07 PM
 */

namespace GoodToKnow\Controllers;


class CreateNewPostTitle
{
    public function page()
    {
        /**
         * The goal is to present a form
         * for entering the two parts
         * which comprise the title of
         * the new post.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['special_topic_array'] = [];
            $_SESSION['last_refresh_topics'] = 1557778345;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'What is the title?';

        require VIEWS . DIRSEP . 'createnewposttitle.php';
    }
}