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

        global $sessionMessage;

        kick_out_loggedoutusers();


        /**
         * I can't assume these post variables exist so I do the following.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $main_title = standard_form_field_prep('main_title', 1, 200);

        $title_extension = standard_form_field_prep('title_extension', 0, 200);


        // Add to session

        $_SESSION['saved_str01'] = $main_title;

        $_SESSION['saved_str02'] = $title_extension;


        // Redirect

        redirect_to("/ax1/CreateNewPostSave/page");
    }
}