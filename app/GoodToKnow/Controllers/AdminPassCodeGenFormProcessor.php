<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\any_community_ff_prep;

class AdminPassCodeGenFormProcessor
{
    function page()
    {
        global $sessionMessage;

        kick_out_nonadmins();

        kick_out_onabort();

        $db = get_db();


        /**
         * Save choice in the session
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'any_community_ff_prep.php';

        $community_id = any_community_ff_prep('choice', $db);

        $_SESSION['saved_int01'] = $community_id;


        /**
         * Present a form where Admin can enter comments
         * about new person/user.
         */

        $html_title = 'Admin Pass-Code Gen Form Processor';

        require VIEWS . DIRSEP . 'adminpasscodegenformprocessor.php';
    }
}