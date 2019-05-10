<?php


namespace GoodToKnow\Controllers;


class TransferPostOwnershipGetPost
{
    public function page()
    {
        /**
         * This route will (1) determine
         * which post the admin chose to do a transfer of ownership to,
         * (2) stores the post's info in the session, and
         * (3) presents a form asking the user if he
         * is sure this is the post he wants to transfer the ownership of.
         *
         * For step (3):
         * Based on the submitted post id the script will
         * derive and present:
         *  - Community name
         *  - Topic name
         *  - Post title | extensionfortitle
         *  - Author username
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
    }
}