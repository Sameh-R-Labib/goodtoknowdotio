<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Community;
use GoodToKnow\Models\CommunityToTopic;
use GoodToKnow\Models\User;
use function GoodToKnow\ControllerHelpers\is_password_syntactically;
use function GoodToKnow\ControllerHelpers\is_username_syntactically;

class LoginScript
{
    function page()
    {
        global $is_logged_in;
        global $sessionMessage;

        $db = db_connect($sessionMessage);

        $submitted_username = '';
        $submitted_password = '';

        self::init($db, $sessionMessage, $is_logged_in);

        self::assimilate_input($sessionMessage, $submitted_username, $submitted_password);

        $user = User::authenticate($db, $sessionMessage, $submitted_username, $submitted_password);

        self::login_the_user($sessionMessage, $user);

        self::store_application_state($db, $sessionMessage, $user);

        self::report_on_findings($sessionMessage);
    }


    /**
     * @param string $error
     */
    private static function report_on_findings(string $error)
    {
        $error .= " GoodToKnow.io works best with 🗺️: Opera, Chrome, Brave. ";
        $_SESSION['message'] = $error;
        reset_feature_session_vars();
        redirect_to("/ax1/Home/page");
    }

    /**
     * @param \mysqli $db
     * @param string $error
     * @param object $user
     */
    private static function store_application_state(\mysqli $db, string &$error, object $user)
    {
        /**
         * Put user's data in session.
         */
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_username'] = $user->username;
        $_SESSION['role'] = $user->role;
        $_SESSION['community_id'] = $user->id_of_default_community;
        $_SESSION['is_suspended'] = $user->is_suspended;
        /**
         * Other things we want to put in session:
         *  - community_name (corresponds with community_id)
         *  - special_community_array (array described below)
         */

        /**
         * Put the community_name which corresponds with
         * community_id in the session.
         */
        $community_object = Community::find_by_id($db, $error, $user->id_of_default_community);

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
        $special_community_array = EnfoFindCommunitiesOfUser::find_communities_of_user($db, $error, $user->id);

        if ($special_community_array === false) {
            $error .= " Failed to find the array of the user's communities. ";
            $_SESSION['message'] = $error;
            reset_feature_session_vars();
            redirect_to("/ax1/LoginForm/page");
        }


        /**
         * Finally save them to session
         */

        $_SESSION['special_community_array'] = $special_community_array;
        $_SESSION['last_refresh_communities'] = time();
        $_SESSION['type_of_resource_requested'] = 'community';
        $_SESSION['topic_id'] = 0;
        $_SESSION['post_id'] = 0;


        /**
         * Find and save in session a value for special_topic_array.
         */

        $special_topic_array = CommunityToTopic::get_topics_array_for_a_community($db, $error, $user->id_of_default_community);

        if (!$special_topic_array) {
            $error .= " I did'nt find any topics for your default community. ";
            $_SESSION['message'] .= $error;

            redirect_to("/ax1/Home/page");
        }

        $_SESSION['special_topic_array'] = $special_topic_array;
        $_SESSION['last_refresh_topics'] = time();
    }

    /**
     * @param string $error
     * @param $user
     */
    private static function login_the_user(string $error, $user)
    {
        if ($user === false) {
            $error .= " Authentication failed! ";
            $_SESSION['message'] = $error;
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
            $error .= " No active account exists for this username. ";
            $_SESSION['message'] = $error;
            reset_feature_session_vars();
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * This counts as a suspension check therefore:
         */
        $_SESSION['when_last_checked_suspend'] = time();
    }

    /**
     * @param string $error
     * @param string $submitted_username
     * @param string $submitted_password
     */
    private static function assimilate_input(string $error, string &$submitted_username, string &$submitted_password)
    {
        $submitted_username = (isset($_POST['username'])) ? $_POST['username'] : '';
        $submitted_password = (isset($_POST['password'])) ? $_POST['password'] : '';

        require_once CONTROLLERHELPERS . DIRSEP . 'is_username_syntactically.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'is_password_syntactically.php';

        if (!is_username_syntactically($error, $submitted_username) ||
            !is_password_syntactically($error, $submitted_password)) {
            $_SESSION['message'] = $error;
            reset_feature_session_vars();
            redirect_to("/ax1/LoginForm/page");
        }
    }

    /**
     * @param $db
     * @param $error
     * @param $is_logged_in
     */
    private static function init($db, $error, $is_logged_in)
    {
        if ($is_logged_in) {
            $error .= " I don't know exactly why you ended up on this page but what I do know is that
             you submitted your username and password to log in although the session already considers you logged in. ";
            $_SESSION['message'] = $error;
            reset_feature_session_vars();
            redirect_to("/ax1/InfiniteLoopPrevent/page");
        }

        // For denial of service attacks
        sleep(1);

        if (!empty($error) || $db === false) {
            $error .= ' Database connection failed. ';
            $_SESSION['message'] = $error;
            reset_feature_session_vars();
            redirect_to("/ax1/LoginForm/page");
        }
    }
}