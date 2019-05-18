<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-02-22
 * Time: 16:33
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\User;
use GoodToKnow\Models\UserToCommunity;


class RemoveComsChoices
{
    public function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $saved_str01; // Has user's username

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         * Goals:
         *  1) Get the id of the user.
         *  2) Save the id in the session in saved_int01.
         *  3) Get all the communities the user belongs to.
         *  4) Present them as check boxes
         */

        /**
         * 1) Get the id of the user.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        $user_object = User::find_by_username($db, $sessionMessage, $saved_str01);
        if (!$user_object) {
            $sessionMessage .= " Unexpected unable to retrieve target user's object. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }
        $user_id = (int)$user_object->id;

        /**
         * 2) Save the id in the session in saved_int01.
         */
        $_SESSION['saved_int01'] = $user_id;

        /**
         * 3) Get all the communities the user belongs to.
         */
        $coms_user_belongs_to = UserToCommunity::coms_user_belongs_to($db, $sessionMessage, $user_id);
        if ($coms_user_belongs_to === false) {
            $sessionMessage .= " Error encountered trying to retrieve communities for this user. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         * 4) Present communities as check boxes
         */

        /**
         * So, we have $coms_user_belongs_to
         *
         * We need to present the ids of those communities (along with their community names)
         * as check boxes in a form.
         */
        $html_title = 'Remove Community Choices';

        require VIEWS . DIRSEP . 'removecomschoices.php';
    }
}