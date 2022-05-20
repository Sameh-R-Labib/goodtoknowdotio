<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\community;
use GoodToKnow\Models\user;
use GoodToKnow\Models\user_to_community;

class give_coms_choices
{
    function page()
    {
        global $g;
        // $g->saved_str01 has user's username


        kick_out_nonadmins_or_if_there_is_error_msg();


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

        get_db();

        $user_object = user::find_by_username($g->saved_str01);

        if (!$user_object) {

            breakout(' Unexpected unable to retrieve user. ');

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

        $g->coms_user_belongs_to = user_to_community::coms_user_belongs_to($user_id);

        if ($g->coms_user_belongs_to === false) {

            breakout(' Error encountered trying to retrieve communities for this user. ');

        }

        // Second get all the communities that exist in this system.
        // By "this system" I mean this instance of the app.

        $coms_in_this_system = community::find_all();

        if ($coms_in_this_system === false) {

            breakout(' Unable to retrieve communities. ');

        }


        // Get communities user DOES NOT belong to.

        $g->coms_user_does_not_belong_to = user_to_community::coms_user_does_not_belong_to($coms_in_this_system);


        // Redirect if there are no communities which user doesn't belong to.

        if (empty($g->coms_user_does_not_belong_to)) {

            breakout(' This user belongs to all communities. Therefore, there is no need to do anything. ');

        }


        /**
         * 4) Present communities as check boxes
         */

        /**
         * So, we have $g->coms_user_does_not_belong_to
         *
         * We need to present the ids of those communities (along with their community names)
         * as check boxes in a form.
         */

        $g->html_title = 'Give Community Choices';

        require VIEWS . DIRSEP . 'givecomschoices.php';
    }
}