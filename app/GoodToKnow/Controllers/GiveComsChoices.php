<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-01-09
 * Time: 16:48
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Community;
use GoodToKnow\Models\User;
use GoodToKnow\Models\UserToCommunity;


class GiveComsChoices
{
    public function page()
    {
        global $is_logged_in;
        global $sessionMessage;
        global $saved_str01; // Has user's username

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Goals:
         *  1) Get the id of the user.
         *  2) Save the id in the session in saved_int01.
         *  3) Get all the communities the user does Not belong to.
         *  4) Present them as check boxes
         */

        /**
         * 1) Get the id of the user.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $user_object = User::find_by_username($db, $sessionMessage, $saved_str01);
        if (!$user_object) {
            $sessionMessage .= " Unexpected unable to retrieve target user's object. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $user_id = (int)$user_object->id;

        /**
         * 2) Save the id in the session in saved_int01.
         */
        $_SESSION['saved_int01'] = $user_id;

        /**
         * 3) Get all the communities the user DOES NOT belong to.
         */

        // First get all the communities the user DOES belong to.
        $coms_user_belongs_to = UserToCommunity::coms_user_belongs_to($db, $sessionMessage, $user_id);
        if ($coms_user_belongs_to === false) {
            $sessionMessage .= " Error encountered trying to retrieve communities for this user. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        // Second get all the communities that exist in this system.
        // By "this system" I mean this instance of the app.
        $coms_in_this_system = Community::find_all($db, $sessionMessage);
        if ($coms_in_this_system === false) {
            $sessionMessage .= " Unable to retrieve any communities. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        // Third based on what we've gathered so far get the communities the user DOES NOT belong to.
    }
}