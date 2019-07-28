<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\BankingAcctForBalances;

class ForgetATask
{
    function page()
    {
        /**
         * Presenting a form for getting the user to tell us
         * which Task record he wants to delete. It will present
         * a series of radio buttons to choose from.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;            // We need this.

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $sql = 'SELECT * FROM `task` WHERE `user_id` = ' . $db->real_escape_string($user_id);
        $array = BankingAcctForBalances::find_by_sql($db, $sessionMessage, $sql);
        if (!$array || !empty($sessionMessage)) {
            $sessionMessage .= ' 🤔 I could NOT find any task records for you ¯\_(ツ)_/¯. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Which task?';

        require VIEWS . DIRSEP . 'forgetatask.php';
    }
}