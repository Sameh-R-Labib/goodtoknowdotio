<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/3/18
 * Time: 5:06 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Community;


class AdminPassCodeGenFormProcessor
{
    public function page()
    {
        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in OR !$is_admin) {
            $_SESSION['message'] = $sessionMessage; // to pass message along since script doesn't output anything
            redirect_to("/ax1/Home/page");
        }

        /**
         * Do something with the submitted post data $_POST['choice']
         */

        /**
         * Make sure we got a value for $_POST['choice']
         * (Is it set? Is it empty?)
         * Otherwise, give error and redirect
         */
        if (empty($_POST['choice'])) {
            $sessionMessage .= " Aborted! Expected submission of choice not found. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }


        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        $community_array = Community::find_all($db, $sessionMessage);

        /**
         * Make sure the value of $_POST['choice'] is one of the existing community ids.
         * Otherwise, give error and redirect
         */
        $is_found = false;
        foreach ($community_array as $value) {
            if ($value->id == $_POST['choice']) {
                $is_found = true;
                continue;
            }
        }
        if (!$is_found) {
            $sessionMessage .= " Aborted! choice is not valid. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Save choice in the session
         */
        $_SESSION['saved_str01'] = $_POST['choice'];


        /**
         * Present a form where Admin can enter comments
         * about new person/user.
         */
        $html_title = 'Admin Pass-Code Gen Form Processor';

        require VIEWS . DIRSEP . 'adminpasscodegenformprocessor.php';
    }
}