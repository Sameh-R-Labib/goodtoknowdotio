<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Community;
use GoodToKnow\Models\ReadableUser;
use GoodToKnow\Models\User;

class UserRoster
{
    function page()
    {
        global $app_state;
        global $db;
        global $show_poof;
        global $readable_user_objects_array;


        kick_out_nonadmins();


        $db = get_db();


        $app_state->html_title = 'User Roster';


        $app_state->page = 'UserRoster';


        $show_poof = true;


        /**
         * Get an array of User objects corresponding
         * to all the Users in the system.
         */

        $user_objects_array = User::find_all();

        if ($user_objects_array === false || empty($user_objects_array)) {

            breakout(' Unable to retrieve any user objects. ');

        }


        /**
         * Replace the field values that can benefit the viewer upon being replaced
         * (so that they present better.)
         */


        // We need to have an array of a different object type called ReadableUser.

        $readable_user_objects_array = [];


        // $community_values_array is a helper for finding $readable_user_objects_array


        // Assign $community_values_array. $community_values_array is described in class ReadableUser.

        $community_values_array = [];

        $array_of_all_community_objects = Community::find_all();

        if ($array_of_all_community_objects === false || empty($array_of_all_community_objects)) {

            breakout(' Unable to retrieve any community objects. ');

        }

        foreach ($array_of_all_community_objects as $community) {

            $community_values_array[$community->id] = $community->community_name;

        }


        // $readable_user_objects_array is what we will use in the view.

        foreach ($user_objects_array as $user) {

            $readable_user_objects_array[] = new ReadableUser($user, $community_values_array);

        }

        $app_state->message .= " I have generated the User Roster (<em>shown below.</em>) ";

        require VIEWS . DIRSEP . 'userroster.php';
    }
}