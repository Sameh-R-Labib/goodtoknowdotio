<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 11/1/18
 * Time: 1:25 PM
 */

namespace GoodToKnow\Controllers;


class MessageTheAuthor
{
    public function page()
    {
        /**
         * This function presents a form where
         * the user can enter a message intended
         * to be received by the author of the
         * post which was most recently displayed
         * on the user's Home page.
         *
         * The textarea input field shall be pre
         * populated with the statement: "Dear {author
         * username},\n\n
         * This is a comment regarding your {post title}
         * post in {topic name} topic of {community
         * name} community.\n\n
         * Sincerely,\n\n
         * {user's username}\n\n"
         *
         * At the top of the form there shall be the
         * statement: "You can use markdown and UTF-8
         * characters."
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Display the editor interface.
         */
        $html_title = 'Message the Author';

        require VIEWS . DIRSEP . 'messagetheauthor.php';
    }
}