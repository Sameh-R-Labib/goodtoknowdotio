<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/4/18
 * Time: 10:04 PM
 */

namespace GoodToKnow\Controllers;


class CreateNewPostTitleProcessor
{
    public function page()
    {
        /**
         * Mission:
         *   - Receive post data for main_title and title_extension
         *   - validate
         *   - Replace html tags with html entities
         *   - Add to session
         *   - Redirect to route for saving the new post
         */
        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * I can't assume these post variables exist so I do the following.
         */
        $main_title = (isset($_POST['main_title'])) ? $_POST['main_title'] : '';
        $title_extension = (isset($_POST['title_extension'])) ? $_POST['title_extension'] : '';

        $main_title = trim($main_title);
        $title_extension = trim($title_extension);

        // Required fields
        if (empty($main_title) || empty($title_extension)) {
            $sessionMessage .= " Either you did not fill out both fields or the session expired. Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (strlen($main_title) > 200 || strlen($title_extension) > 200) {
            $sessionMessage .= " The title or its extension was too long (max 200 bytes.) Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        // Make them safe for HTML
        $main_title = htmlentities($main_title, ENT_QUOTES);
        $title_extension = htmlentities($title_extension, ENT_QUOTES);

        // Add to session
        $_SESSION['saved_str01'] = $main_title;
        $_SESSION['saved_str02'] = $title_extension;

        // Redirect
        redirect_to("/ax1/CreateNewPostSave/page");
    }
}