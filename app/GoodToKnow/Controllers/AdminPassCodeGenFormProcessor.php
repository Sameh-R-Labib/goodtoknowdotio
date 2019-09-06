<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Community;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class AdminPassCodeGenFormProcessor
{
    function page()
    {
        global $sessionMessage;

        kick_out_nonadmins();

        kick_out_onabort();

        $db = get_db();

        $community_array = Community::find_all($db, $sessionMessage);


        /**
         * Make sure the value of $_POST['choice'] is one of the existing community ids.
         * Otherwise, give error and redirect
         */

        $is_found = false;

        foreach ($community_array as $value) {

            if ($value->id == $_POST['choice']) {

                $is_found = true;
                break;

            }
        }

        if (!$is_found) {

            breakout(' Value is not valid. ');

        }


        /**
         * Save choice in the session
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        $_SESSION['saved_int01'] = $chosen_id;


        /**
         * Present a form where Admin can enter comments
         * about new person/user.
         */

        $html_title = 'Admin Pass-Code Gen Form Processor';

        require VIEWS . DIRSEP . 'adminpasscodegenformprocessor.php';
    }
}