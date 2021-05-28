<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Community;
use GoodToKnow\Models\User;
use GoodToKnow\Models\UserToCommunity;

class GiveComsChoices
{
    function page()
    {
        global $db;
        global $saved_str01; // Has user's username
        global $html_title;
        global $coms_user_belongs_to;
        global $coms_user_does_not_belong_to;


        kick_out_nonadmins();


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

        $db = get_db();

        $user_object = User::find_by_username($saved_str01);

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

        $coms_user_belongs_to = UserToCommunity::coms_user_belongs_to($user_id);

        if ($coms_user_belongs_to === false) {

            breakout(' Error encountered trying to retrieve communities for this user. ');

        }

        // Second get all the communities that exist in this system.
        // By "this system" I mean this instance of the app.

        $coms_in_this_system = Community::find_all();

        if ($coms_in_this_system === false) {

            breakout(' Unable to retrieve communities. ');

        }


        // Get communities user DOES NOT belong to.

        $coms_user_does_not_belong_to = UserToCommunity::coms_user_does_not_belong_to($coms_in_this_system, $coms_user_belongs_to);


        // Redirect if no communities user doesn't belong to.

        if (empty($coms_user_does_not_belong_to)) {

            breakout(' This user belongs to all communities. So, there\'s no need to do anything. ');

        }


        /**
         * 4) Present communities as check boxes
         */

        /**
         * So, we have $coms_user_does_not_belong_to
         *
         * We need to present the ids of those communities (along with their community names)
         * as check boxes in a form.
         */

        $html_title = 'Give Community Choices';

        require VIEWS . DIRSEP . 'givecomschoices.php';
    }
}