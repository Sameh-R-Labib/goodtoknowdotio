<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\any_community_validate_page_parameter;

class admin_pass_code_gen_form_processor
{
    function page(int $id = 0)
    {
        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        get_db();


        $g->id = $id;


        /**
         * Save choice in the session
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'any_community_validate_page_parameter.php';

        any_community_validate_page_parameter();

        $_SESSION['saved_int01'] = $g->id;


        /**
         * Present a form where Admin can enter comments about new person/user.
         */

        $g->html_title = 'Admin Pass-Code Gen Form Processor';

        require VIEWS . DIRSEP . 'adminpasscodegenformprocessor.php';
    }
}