<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Post;
use GoodToKnow\Models\TopicToPost;


class QuickPostDeleteDelProc
{
    public function page()
    {
        /**
         * Here we will read the choice of whether
         * or not to delete the post. If yes then
         * delete the post record, delete its
         * TopicToPost record, and delete its
         * html and markdown files. On the other
         * hand if no then reset some session variables
         * and redirect to the home page.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int02;
        global $saved_int01;
        global $saved_str01;
        global $saved_str02;
        global $is_admin;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }


    }
}