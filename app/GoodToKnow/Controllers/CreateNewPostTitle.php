<?php

namespace GoodToKnow\Controllers;

class CreateNewPostTitle
{
    function page()
    {
        /**
         * Present a form for entering the two parts which comprise the title of the new post.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        $html_title = 'What is the title?';

        require VIEWS . DIRSEP . 'createnewposttitle.php';
    }
}