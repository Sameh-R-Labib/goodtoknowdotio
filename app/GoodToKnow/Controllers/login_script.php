<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\user_to_community;
use GoodToKnow\Models\community;
use GoodToKnow\Models\community_to_topic;
use GoodToKnow\Models\user;
use function GoodToKnow\ControllerHelpers\is_password_syntactically;
use function GoodToKnow\ControllerHelpers\is_username_syntactically;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class login_script
{
    function page()
    {
        global $g;

        $g->db = db_connect();

        $submitted_username = '';
        $submitted_password = '';


        self::init();

        self::assimilate_input($submitted_username, $submitted_password);

        $user = user::authenticate($submitted_username, $submitted_password);

        self::login_the_user($user);

        self::store_application_state($user);

        require VIEWS . DIRSEP . 'loginscript.php';
    }

    /**
     * @param object $user
     */
    private static function store_application_state(object $user)
    {
        global $g;

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
        $community_object = community::find_by_id($user->id_of_default_community);

        $_SESSION['community_name'] = $community_object->community_name;

        $_SESSION['community_description'] = $community_object->community_description;

        /**
         * I need to use a method of user_to_community to
         * find out which communities this user belongs to.
         * Then I'll use that information along with information
         * from the community table to be able to have
         * an array of the communities corresponding
         * to the current user.
         *
         * The structure of that array:
         *  - associative
         *  - Key is a community id
         *  - Value is a community name
         */
        $g->special_community_array = user_to_community::find_communities_of_user($user->id);

        if ($g->special_community_array === false) {

            $g->message .= " Failed to find the array of the user's communities. ";
            $g->is_logged_in = false;
            $_SESSION['is_logged_in'] = $g->is_logged_in;
            reset_feature_session_vars();
            redirect_to("/ax1/login_form/page");

        }


        /**
         * Finally save them to session
         */

        $_SESSION['special_community_array'] = $g->special_community_array;
        $_SESSION['last_refresh_communities'] = time();
        $_SESSION['type_of_resource_requested'] = 'community';
        $_SESSION['topic_id'] = 0;
        $_SESSION['post_id'] = 0;


        /**
         * Find and save in session a value for special_topic_array.
         */

        $g->special_topic_array = community_to_topic::get_topics_array_for_a_community($user->id_of_default_community);

        if (!$g->special_topic_array) {

            $g->message .= " I didn't find any topics for your default community. ";

        } else {

            $_SESSION['special_topic_array'] = $g->special_topic_array;
            $_SESSION['last_refresh_topics'] = time();

        }
    }


    /**
     * @param $user
     */
    private static function login_the_user($user)
    {
        global $g;

        if ($user === false) {

            $g->message .= " Authentication failed! ";
            $g->is_logged_in = false;
            $_SESSION['is_logged_in'] = $g->is_logged_in;
            reset_feature_session_vars();
            redirect_to("/ax1/login_form/page");

        }

        /**
         * So we have a user object.
         */

        /**
         * If this user is suspended don't let them in.
         */
        if ($user->is_suspended) {

            $g->message .= " No active account exists for this username. ";
            $g->is_logged_in = false;
            $_SESSION['is_logged_in'] = $g->is_logged_in;
            reset_feature_session_vars();
            redirect_to("/ax1/login_form/page");

        }

        /**
         * This counts as a suspension check therefore:
         */
        $_SESSION['when_last_checked_suspend'] = time();


        /**
         * This is the only indication that the user is logged in.
         */
        $g->is_logged_in = true;
        $_SESSION['is_logged_in'] = $g->is_logged_in;
    }


    /**
     * @param string $submitted_username
     * @param string $submitted_password
     */
    private static function assimilate_input(string &$submitted_username, string &$submitted_password)
    {
        global $g;

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $submitted_username = standard_form_field_prep('username', 7, 12);

        $submitted_password = standard_form_field_prep('password', 10, 264);


        require_once CONTROLLERHELPERS . DIRSEP . 'is_username_syntactically.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'is_password_syntactically.php';

        if (!is_username_syntactically($submitted_username) ||
            !is_password_syntactically($submitted_password)) {

            $g->message .= " I think you mistyped something. ";
            $g->is_logged_in = false;
            $_SESSION['is_logged_in'] = $g->is_logged_in;
            reset_feature_session_vars();
            redirect_to("/ax1/login_form/page");

        }
    }

    /**
     *
     */
    private static function init()
    {
        global $g;

        if ($g->is_logged_in) {

            $g->message .= " I don't know exactly why you ended up on this page but what I do know is that
             you submitted your username and password to log in although the session already considers you logged in. ";

            breakout('');

        }

        // For denial of service attacks
        sleep(1);

        if (!empty($g->message) || $g->db === false) {

            $g->message .= ' Database connection failed. ';
            $g->is_logged_in = false;
            $_SESSION['is_logged_in'] = $g->is_logged_in;
            reset_feature_session_vars();
            redirect_to("/ax1/login_form/page");

        }
    }
}