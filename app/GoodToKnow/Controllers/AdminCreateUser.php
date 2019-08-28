<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\User;
use GoodToKnow\Models\UserToCommunity;
use function GoodToKnow\ControllerHelpers\is_date;
use function GoodToKnow\ControllerHelpers\is_password_asapair;
use function GoodToKnow\ControllerHelpers\is_username_usable_for_registration;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class AdminCreateUser
{
    function page()
    {
        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;
        global $saved_int01; // choice

        kick_out_nonadmins();

        kick_out_onabort();

        $db = get_db();


        /**
         * Variables to work with:
         *   $saved_int01, $_POST['username'], $_POST['first_try'], $_POST['password'],
         *   $_POST['title'], $_POST['race'], $_POST['comment'], $_POST['date'], $_POST['submit']
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $submitted_username = standard_form_field_prep('username', 7, 12);

        $submitted_first_try = standard_form_field_prep('first_try', 7, 264);

        $submitted_password = standard_form_field_prep('password', 7, 264);

        $submitted_title = (isset($_POST['title'])) ? $_POST['title'] : '';

        $submitted_race = (isset($_POST['race'])) ? $_POST['race'] : '';

        $submitted_comment = standard_form_field_prep('comment', 0, 800);

        $submitted_date = standard_form_field_prep('date', 10, 14);

        if (is_null($submitted_username) || is_null($submitted_comment) || is_null($submitted_date) ||
            is_null($submitted_first_try) || is_null($submitted_password)) {

            breakout(' One or more values is invalid. ');
        }


        /**
         * $new_user_role needs to have a value
         * since there is a role field in the users table
         */

        $new_user_role = '';
        $new_user_is_suspended = 0;


        /**
         * If any of the submitted fields are invalid
         * store a session message and redirect to /ax1/Home/page
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'is_username_usable_for_registration.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'is_password_asapair.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'is_date.php';

        if (!is_username_usable_for_registration($db, $sessionMessage, $submitted_username) ||
            !is_password_asapair($sessionMessage, $submitted_first_try, $submitted_password) ||
            !self::is_title($sessionMessage, $submitted_title) ||
            !self::is_race($sessionMessage, $submitted_race) ||
            !is_date($sessionMessage, $submitted_date)) {

            breakout(' One of the submitted field values is invalid. ');
        }


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
            'id_of_default_community' => $saved_int01,
            'title' => $submitted_title,
            'role' => $new_user_role,
            'race' => $submitted_race,
            'is_suspended' => $new_user_is_suspended,
            'date' => $submitted_date,
            'comment' => $submitted_comment];


        // Second step

        $new_user_object = User::array_to_object($array_of_submitted_data);


        // Third step

        $consequence_of_save = $new_user_object->save($db, $sessionMessage);

        if (!$consequence_of_save) {
            breakout(' The save method for User returned false. ');
        }

        if (!empty($sessionMessage)) {
            breakout(' The save method for User did not return false but it did send back a message.
             Therefore, it probably did not create your account. ');
        }


        /**
         * Store association between user and community.
         */

        // The three steps again

        $array_of_user_to_community_row_data = ['user_id' => $new_user_object->id, 'community_id' => $saved_int01];

        $new_user_to_community_object = UserToCommunity::array_to_object($array_of_user_to_community_row_data);

        $consequence_of_save = $new_user_to_community_object->save($db, $sessionMessage);

        if (!$consequence_of_save) {
            breakout(' The save method for UserToCommunity returned false. ');
        }

        if (!empty($sessionMessage)) {
            breakout(' The save method for UserToCommunity did not return false but it did send back a message.
             Therefore, it probably did not create the association for your account. ');
        }


        /**
         * Announce success.
         */

        breakout(' The user account was created! ');
    }

    // Helpers for the page() method

    /**
     * @param $message
     * @param string $title
     * @return bool
     */
    public static function is_title(string &$message, string &$title)
    {
        /**
         * Trim it.
         * Can't be empty.
         * Mr. and Mrs. are the only valid values for title.
         */
        $title = trim($title);

        if (empty($title)) {
            $message .= " Your title is missing. ";
            return false;
        }

        $possible = ['Mr.', 'Mrs.'];
        if (!in_array($title, $possible)) {
            $message .= " Your title field does not contain a valid value. ";
            return false;
        }

        return true;
    }

    /**
     * @param $message
     * @param string $race
     * @return bool
     */
    public static function is_race(string &$message, string &$race)
    {
        /**
         * Trim it.
         * Can't be empty.
         * Must be one of the ones I have in the form.
         */
        $race = trim($race);
        if (empty($race)) {
            $message .= " The value for race is missing. ";
            return false;
        }

        $races = ['caucasian-american', 'caucasian-european', 'caucasian-african', 'black-european', 'black-american',
            'black-african', 'asian', 'south-american', 'greek', 'middle-eastern-christian', 'middle-eastern-moslem',
            'native-american'];

        if (!in_array($race, $races)) {
            $message .= " Your race field does not contain a valid value. ";
            return false;
        }

        return true;
    }
}