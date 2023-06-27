<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\community;
use GoodToKnow\Models\readable_user;
use GoodToKnow\Models\user;

class user_roster
{
    function page()
    {
        global $g;


        kick_out_nonadmins();


        get_db();


        $g->html_title = 'User Roster';


        $g->page = 'user_roster';


        $g->show_poof = true;


        /**
         * Get an array of user objects corresponding
         * to all the users in the system.
         */

        $user_objects_array = user::find_all();

        if ($user_objects_array === false || empty($user_objects_array)) {

            breakout(' Unable to retrieve any user objects. ');

        }


        /**
         * Replace the field values that can benefit the viewer upon being replaced
         * (so that they present better.)
         */


        // We need to have an array of a different object type called readable_user.


        // $community_values_array is a helper for finding $g->readable_user_objects_array


        // Assign $community_values_array. $community_values_array is described in class readable_user.

        $community_values_array = [];

        $array_of_all_community_objects = community::find_all();

        if ($array_of_all_community_objects === false || empty($array_of_all_community_objects)) {

            breakout(' Unable to retrieve any community objects. ');

        }

        foreach ($array_of_all_community_objects as $community) {

            $community_values_array[$community->id] = $community->community_name;

        }


        // $g->readable_user_objects_array is what we will use in the view.

        foreach ($user_objects_array as $user) {

            $g->readable_user_objects_array[] = new readable_user($user, $community_values_array);

        }


        $g->message .= " I have generated the User Roster (<em>shown below.</em>) ";
        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'userroster.php';
    }
}