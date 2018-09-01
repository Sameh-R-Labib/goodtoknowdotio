<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/27/18
 * Time: 10:01 PM
 */

namespace GoodToKnow\Controllers;


class AdminPassCodeGenerationForm
{
    public function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        if (!$is_logged_in OR !$is_admin) {
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * Here we need to have an enumerated array
         * of community objects. We will use this array
         * in the view template to generate each radio
         * input field. Each object has:
         *   - community_id
         *   - community_name
         *   - community_description
         */
        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1");
        }

        $html_title = 'Admin Pass-Code Generation Form';

        require VIEWS . DIRSEP . 'adminpasscodegenerationform.php';
    }
}