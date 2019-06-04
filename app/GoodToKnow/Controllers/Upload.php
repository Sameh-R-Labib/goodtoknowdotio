<?php


namespace GoodToKnow\Controllers;


class Upload
{
    public function page()
    {
        /**
         * The goal of this series of routes
         * is to make it possible to upload
         * an image file (jpg, jpeg, png, gif)
         * to the IMAGE folder on the server
         * and to save its URL to the session
         * variable called url_of_most_recent_upload.
         * It shall do all this while making sure
         * the upload contains no malicious code.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Display the editor interface.
         */
        $html_title = 'Upload an image';

        require VIEWS . DIRSEP . 'upload.php';
    }
}