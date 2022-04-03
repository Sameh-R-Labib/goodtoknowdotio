<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\User;
use GoodToKnow\Models\user_to_community;

class remove_coms_choices
{
    function page()
    {
        global $g;
        // $g->saved_str01 is user's username


        kick_out_nonadmins_or_if_there_is_error_msg();


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

        get_db();

        $user_object = User::find_by_username($g->saved_str01);

        if (!$user_object) {

            breakout(' Unexpected unable to retrieve target user\'s object. ');

        }

        $user_id = (int)$user_object->id;


        /**
         * 2) Save the id in the session in saved_int01.
         */

        $_SESSION['saved_int01'] = $user_id;


        /**
         * 3) Get all the communities the user belongs to.
         */

        $g->coms_user_belongs_to = user_to_community::coms_user_belongs_to($user_id);

        if ($g->coms_user_belongs_to === false) {

            breakout(' Error encountered trying to retrieve communities for this user. ');

        }


        /**
         * 4) Present communities as check boxes
         */

        $g->html_title = 'Remove Community Choices';

        require VIEWS . DIRSEP . 'removecomschoices.php';
    }
}