<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\any_community_ff_prep;

class AdminPassCodeGenFormProcessor
{
    function page()
    {
        global $gtk;
        global $db;


        kick_out_nonadmins();


        $db = get_db();


        /**
         * Save choice in the session
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'any_community_ff_prep.php';

        $community_id = any_community_ff_prep();

        $_SESSION['saved_int01'] = $community_id;


        /**
         * Present a form where Admin can enter comments about new person/user.
         */

        $gtk->html_title = 'Admin Pass-Code Gen Form Processor';

        require VIEWS . DIRSEP . 'adminpasscodegenformprocessor.php';
    }
}