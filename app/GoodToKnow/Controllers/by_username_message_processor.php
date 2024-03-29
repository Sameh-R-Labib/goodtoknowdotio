<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\is_username_syntactandexists;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class by_username_message_processor
{
    function page()
    {
        /**
         * Basically what needs to get accomplished here is to validate the submitted username and present
         * the next form (which is for entering the text of the message.) We MUST also save the username in
         * the session.
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Read the username.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $submitted_username = standard_form_field_prep('username', 7, 12);


        /**
         * Make sure $submitted_username is valid.
         */

        get_db();

        require_once CONTROLLERHELPERS . DIRSEP . 'is_username_syntactandexists.php';

        $is_username = is_username_syntactandexists($submitted_username);

        if (!$is_username) {

            breakout(' The username is not valid. ');

        }

        $_SESSION['saved_str01'] = $submitted_username;

        $g->pre_populate = <<<ROI
Dear $submitted_username,

I have something I want to tell you.

Sincerely,

{$g->user_username}
ROI;

        $g->html_title = "Compose message for $submitted_username";

        require VIEWS . DIRSEP . 'byusernamemprocessor.php';
    }
}