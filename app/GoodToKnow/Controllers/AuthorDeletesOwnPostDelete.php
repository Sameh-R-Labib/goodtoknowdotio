<?php


namespace GoodToKnow\Controllers;


class AuthorDeletesOwnPostDelete
{
    public function page()
    {
        /**
         * This route will simply determine
         * which post the user chose to delete,
         * store its info in the session, and
         * present a form asking the user if he
         * is sure he wants to delete the post.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
    }
}