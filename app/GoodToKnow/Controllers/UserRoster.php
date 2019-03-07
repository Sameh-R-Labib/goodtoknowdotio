<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-03-03
 * Time: 22:34
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Community;
use GoodToKnow\Models\ReadableUser;
use GoodToKnow\Models\User;

class UserRoster
{
    public function page()
    {
        global $sessionMessage;
        global $is_logged_in;
        global $is_admin;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'User Roster';

        $page = 'UserRoster';

        $show_poof = true;

        /**
         * Get an array of User objects corresponding
         * to all the Users in the system.
         */
        $user_objects_array = User::find_all($db, $sessionMessage);

        if ($user_objects_array === false || empty($user_objects_array)) {
            $sessionMessage .= " Unable to retrieve any user objects. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
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
        $array_of_all_community_objects = Community::find_all($db, $sessionMessage);
        if ($array_of_all_community_objects === false || empty($array_of_all_community_objects)) {
            $sessionMessage .= " Unable to retrieve any community objects. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        foreach ($array_of_all_community_objects as $community) {
            $community_values_array[$community->id] = $community->community_name;
        }

        // $readable_user_objects_array is what we will use in the view.
        foreach ($user_objects_array as $user) {
            $readable_user_objects_array[] = new ReadableUser($user, $community_values_array);
        }


    }
}