<?php


namespace GoodToKnow\Controllers;


class QuickPostDeleteProcessor
{
    public function page()
    {
        global $special_topic_array;
        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }


    }
}