<?php


namespace GoodToKnow\Controllers;


class TransferPostOwnership
{
    public function page()
    {
        /**
         * This is the first route for transferring ownership of a post.
         *
         * It's goal is to be the first in a bunch of routes to determine which post is to be deleted.
         *
         * It will present radio buttons for choosing which topic the post is in.
         * It will also describe what is being done.
         *
         * As usual the topics presented are the topics in the current community.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $community_id;
        global $is_admin;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
    }
}