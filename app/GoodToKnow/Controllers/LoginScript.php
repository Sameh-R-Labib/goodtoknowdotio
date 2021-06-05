<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\UserToCommunity;
use GoodToKnow\Models\Community;
use GoodToKnow\Models\CommunityToTopic;
use GoodToKnow\Models\User;
use function GoodToKnow\ControllerHelpers\is_password_syntactically;
use function GoodToKnow\ControllerHelpers\is_username_syntactically;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class LoginScript
{
    function page()
    {
        global $app_state;
        global $db;

        $db = db_connect();

        $submitted_username = '';
        $submitted_password = '';


        self::init();

        self::assimilate_input($submitted_username, $submitted_password);

        $user = User::authenticate($submitted_username, $submitted_password);

        self::login_the_user($user);

        self::store_application_state($user);

        breakout(' Logout once a day so that your session will Not expire. ');
    }

    /**
     * @param object $user
     */
    private static function store_application_state(object $user)
    {
        global $app_state;

        /**
         * Put user's data in session.
         */
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_username'] = $user->username;
        $_SESSION['role'] = $user->role;
        $_SESSION['community_id'] = $user->id_of_default_community;
        $_SESSION['is_suspended'] = $user->is_suspended;
        $_SESSION['timezone'] = $user->timezone;
        /**
         * Other things we want to put in session:
         *  - community_name (corresponds with community_id)
         *  - special_community_array (array described below)
         */

        /**
         * Put the community_name which corresponds with
         * community_id in the session.
         */
        $community_object = Community::find_by_id($user->id_of_default_community);

        $_SESSION['community_name'] = $community_object->community_name;

        $_SESSION['community_description'] = $community_object->community_description;

        /**
         * I need to use a method of UserToCommunity to
         * find out which communities this user belongs to.
         * Then I'll use that information along with information
         * from the communities table to be able to have
         * an array of the communities corresponding
         * to the current user.
         *
         * The structure of that array:
         *  - associative
         *  - Key is a community id
         *  - Value is a community name
         */
        $app_state->special_community_array = UserToCommunity::find_communities_of_user($user->id);

        if ($app_state->special_community_array === false) {

            $app_state->message .= " Failed to find the array of the user's communities. ";
            $_SESSION['message'] = $app_state->message;
            reset_feature_session_vars();
            redirect_to("/ax1/LoginForm/page");

        }


        /**
         * Finally save them to session
         */

        $_SESSION['special_community_array'] = $app_state->special_community_array;
        $_SESSION['last_refresh_communities'] = time();
        $_SESSION['type_of_resource_requested'] = 'community';
        $_SESSION['topic_id'] = 0;
        $_SESSION['post_id'] = 0;


        /**
         * Find and save in session a value for special_topic_array.
         */

        $app_state->special_topic_array = CommunityToTopic::get_topics_array_for_a_community($user->id_of_default_community);

        if (!$app_state->special_topic_array) {

            $app_state->message .= " I didn't find any topics for your default community. ";
            $_SESSION['message'] .= $app_state->message;

            redirect_to("/ax1/Home/page");

        }

        $_SESSION['special_topic_array'] = $app_state->special_topic_array;
        $_SESSION['last_refresh_topics'] = time();
    }


    /**
     * @param $user
     */
    private static function login_the_user($user)
    {
        global $app_state;

        if ($user === false) {

            $app_state->message .= " Authentication failed! ";
            $_SESSION['message'] = $app_state->message;
            reset_feature_session_vars();
            redirect_to("/ax1/LoginForm/page");

        }

        /**
         * So we have a User object.
         */

        /**
         * If this user is suspended don't let them in.
         */
        if ($user->is_suspended) {

            $app_state->message .= " No active account exists for this username. ";
            $_SESSION['message'] = $app_state->message;
            reset_feature_session_vars();
            redirect_to("/ax1/LoginForm/page");

        }

        /**
         * This counts as a suspension check therefore:
         */
        $_SESSION['when_last_checked_suspend'] = time();
    }


    /**
     * @param string $submitted_username
     * @param string $submitted_password
     */
    private static function assimilate_input(string &$submitted_username, string &$submitted_password)
    {
        global $app_state;

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $submitted_username = standard_form_field_prep('username', 7, 12);

        $submitted_password = standard_form_field_prep('password', 10, 264);


        require_once CONTROLLERHELPERS . DIRSEP . 'is_username_syntactically.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'is_password_syntactically.php';

        if (!is_username_syntactically($submitted_username) ||
            !is_password_syntactically($submitted_password)) {

            $_SESSION['message'] = $app_state->message;
            reset_feature_session_vars();
            redirect_to("/ax1/LoginForm/page");

        }
    }

    /**
     *
     */
    private static function init()
    {
        global $app_state;
        global $db;

        if ($app_state->is_logged_in) {

            $app_state->message .= " I don't know exactly why you ended up on this page but what I do know is that
             you submitted your username and password to log in although the session already considers you logged in. ";
            $_SESSION['message'] = $app_state->message;
            reset_feature_session_vars();
            redirect_to("/ax1/InfiniteLoopPrevent/page");

        }

        // For denial of service attacks
        sleep(1);

        if (!empty($app_state->message) || $db === false) {

            $app_state->message .= ' Database connection failed. ';
            $_SESSION['message'] = $app_state->message;
            reset_feature_session_vars();
            redirect_to("/ax1/LoginForm/page");

        }
    }
}