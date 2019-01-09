<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-01-09
 * Time: 16:48
 */

namespace GoodToKnow\Controllers;


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

    }
}