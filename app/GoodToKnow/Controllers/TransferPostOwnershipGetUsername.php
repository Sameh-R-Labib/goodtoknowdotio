<?php

namespace GoodToKnow\Controllers;

class TransferPostOwnershipGetUsername
{
    function page()
    {
        /**
         * This will process the confirmation form and generate a form whereby the admin can supply the username of the
         * person who will become the new owner of the post.
         *
         * If the confirmation is negative then it will reset the session variables used so far and redirect to home page.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            breakout('');
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }

        $choice = (isset($_POST['choice'])) ? $_POST['choice'] : "";

        if ($choice != "yes" && $choice != "no") {
            breakout(' You didn\'t enter a choice. ');
        }

        if ($choice == "no") {
            breakout(' You changed your mind about transferring ownership of the post. ');
        }

        $html_title = 'What is the username of the person?';

        require VIEWS . DIRSEP . 'transferpostownershipgetusername.php';
    }
}