<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\User;
use GoodToKnow\Models\UserToCommunity;
use function GoodToKnow\ControllerHelpers\date_form_field_prep;
use function GoodToKnow\ControllerHelpers\password_for_regandchange_prep;
use function GoodToKnow\ControllerHelpers\race_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;
use function GoodToKnow\ControllerHelpers\timezone_form_field_prep;
use function GoodToKnow\ControllerHelpers\title_ofaperson_form_field_prep;
use function GoodToKnow\ControllerHelpers\username_for_registration_prep;

class AdminCreateUser
{
    function page()
    {
        global $app_state;
        // $app_state->saved_int01 choice
        global $db;

        kick_out_nonadmins();

        $db = get_db();


        /**
         * Variables to work with:
         *   $app_state->saved_int01, 'username', 'first_try', 'password',
         *   'title', 'race', 'comment', 'timezone', 'date', 'submit'
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'date_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'title_ofaperson_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'race_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'username_for_registration_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'password_for_regandchange_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'timezone_form_field_prep.php';

        $submitted_username = username_for_registration_prep();

        $submitted_password = password_for_regandchange_prep();

        $submitted_title = title_ofaperson_form_field_prep('title');

        $submitted_race = race_form_field_prep('race');

        $submitted_comment = standard_form_field_prep('comment', 0, 800);

        $submitted_timezone = timezone_form_field_prep('timezone');

        $submitted_date = date_form_field_prep('date');


        /**
         * $new_user_role needs to have a value
         * since there is a role field in the users table
         */

        $new_user_role = '';
        $new_user_is_suspended = 0;


        /**
         * Store user.
         *
         * The password needs to be processed before save().
         */

        $hash_of_submitted_password = password_hash($submitted_password, PASSWORD_DEFAULT);

        // See steps in GoodObject for storing a new object.


        // First step:

        $array_of_submitted_data = ['username' => $submitted_username,
            'password' => $hash_of_submitted_password,
            'id_of_default_community' => $app_state->saved_int01,
            'timezone' => $submitted_timezone,
            'title' => $submitted_title,
            'role' => $new_user_role,
            'race' => $submitted_race,
            'is_suspended' => $new_user_is_suspended,
            'date' => $submitted_date,
            'comment' => $submitted_comment];


        // Second step

        $new_user_object = User::array_to_object($array_of_submitted_data);


        // Third step

        $consequence_of_save = $new_user_object->save();

        if (!$consequence_of_save) {

            breakout(' The save method for User returned false. ');

        }

        if (!empty($app_state->message)) {

            breakout(' The save method for User did not return false but it did send back a message.
             Therefore, it probably did not create your account. ');

        }


        /**
         * Store association between user and community.
         */

        // The three steps again

        $array_of_user_to_community_row_data = ['user_id' => $new_user_object->id, 'community_id' => $app_state->saved_int01];

        $new_user_to_community_object = UserToCommunity::array_to_object($array_of_user_to_community_row_data);

        $consequence_of_save = $new_user_to_community_object->save();

        if (!$consequence_of_save) {

            breakout(' The save method for UserToCommunity returned false. ');

        }

        if (!empty($app_state->message)) {

            breakout(' The save method for UserToCommunity did not return false but it did send back a message.
             Therefore, it probably did not create the association for your account. ');

        }


        /**
         * Announce success.
         */

        breakout(' The new user account has just been created 👍🏽 ');
    }
}