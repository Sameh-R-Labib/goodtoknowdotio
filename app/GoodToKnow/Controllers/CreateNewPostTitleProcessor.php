<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class CreateNewPostTitleProcessor
{
    function page()
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

        kick_out_loggedoutusers();

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }


        /**
         * I can't assume these post variables exist so I do the following.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $main_title = standard_form_field_prep('main_title', 1, 200);

        $title_extension = standard_form_field_prep('title_extension', 0, 200);

        if (is_null($main_title) || is_null($title_extension)) {
            breakout(' The values you entered did not pass validation. ');
        }


        // Add to session

        $_SESSION['saved_str01'] = $main_title;

        $_SESSION['saved_str02'] = $title_extension;


        // Redirect

        redirect_to("/ax1/CreateNewPostSave/page");
    }
}