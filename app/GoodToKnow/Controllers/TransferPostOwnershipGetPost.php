<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Post;


class TransferPostOwnershipGetPost
{
    public function page()
    {
        /**
         * This route will (1) determine
         * which post the admin chose to do a transfer of ownership to,
         * (2) stores the post's id in the session, and
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

        // (1) determine which post the admin chose to do a transfer of ownership to

        $chosen_post_id = (isset($_POST['choice'])) ? (int)$_POST['choice'] : 0;

        if ($chosen_post_id == 0) {
            $sessionMessage .= " You didn't enter a choice for the post you want to edit. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $post_object = Post::find_by_id($db, $sessionMessage, $chosen_post_id);

        if (!$post_object) {
            $sessionMessage .= " EditMyPostEditor::page says: Error 011299. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        // (2) stores the post's id in the session

        $_SESSION['saved_int02'] = $chosen_post_id;

        // (3) presents a form asking the user if he is sure
        // this is the post he wants to transfer the ownership of.

        $long_title_of_post = $post_object->title . " | " . $post_object->extensionfortitle;


        // Call the view

        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'transferpostownershipgetpost.php';
    }
}