<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/10/18
 * Time: 9:42 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Community;
use GoodToKnow\Models\CommunityToTopic;
use GoodToKnow\Models\User;
use GoodToKnow\Models\UserToCommunity;


class LoginScript
{
    public function page()
    {
        global $is_logged_in;
        global $sessionMessage;

        if ($is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/InfiniteLoopPrevent/page");
        }

        /*
         * For denial of service attacks
         */
        sleep(1);

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * Variables to work with:
         *   $_POST['username'], $_POST['password']
         *
         * I can't assume these post variables exist so I do the following.
         */

        $submitted_username = (isset($_POST['username'])) ? $_POST['username'] : '';
        $submitted_password = (isset($_POST['password'])) ? $_POST['password'] : '';

        /**
         * If any of the submitted fields are invalid
         * store a session message and redirect to /ax1/LoginForm/page
         */
        if (!self::is_username($sessionMessage, $submitted_username) ||
            !self::is_password($sessionMessage, $submitted_password)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * authenticate never returns true it returns an object instead.
         **/
        $user = User::authenticate($db, $sessionMessage, $submitted_username, $submitted_password);

        if ($user === false) {
            $sessionMessage .= " Authentication failed! ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * So we have a User object.
         */

        /**
         * If this user is suspended don't let them in.
         */
        if ($user->is_suspended) {
            $sessionMessage .= " No active account exists for this username. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

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
        $community_object = Community::find_by_id($db, $sessionMessage, $user->id_of_default_community);
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

        /**
         * So, the first get all the communities
         * for the user.
         */
        $sql = 'SELECT * FROM user_to_community WHERE `user_id`=' . $user->id;
        $user_to_community_array = UserToCommunity::find_by_sql($db, $sessionMessage, $sql);

        if (!$user_to_community_array) {
            $sessionMessage .= " LoginScript page() says unexpected no user_to_community_array. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * Build the array I'm looking for.
         */
        $special_community_array = [];
        foreach ($user_to_community_array as $value) {
            // Talking about the right side of the assignment statement
            // First we're getting a Community object
            $special_community_array[$value->community_id] = Community::find_by_id($db, $sessionMessage, $value->community_id);
            if (!$special_community_array[$value->community_id]) {
                $sessionMessage .= " LoginScript page() says err_no 80848. ";
                $_SESSION['message'] = $sessionMessage;
                redirect_to("/ax1/LoginForm/page");
            }
            // Then we're getting the community_name from that object
            $special_community_array[$value->community_id] = $special_community_array[$value->community_id]->community_name;
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
        $special_topic_array = CommunityToTopic::get_topics_array_for_a_community($db, $sessionMessage, $user->id_of_default_community);
        if (!$special_topic_array) {
            $sessionMessage .= " I did'nt find any topics for your default community. ";
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        $_SESSION['special_topic_array'] = $special_topic_array;
        $_SESSION['last_refresh_topics'] = time();

        /**
         * Report success
         */
        $sessionMessage .= " Welcome back! ";
        $_SESSION['message'] = $sessionMessage;
        redirect_to("/ax1/Home/page");
    }

    /**
     * @param string $message
     * @param string $username
     * @return bool
     */
    public static function is_username(string &$message, string &$username)
    {
        /**
         * We want to prevent sql injection
         */
        $username = trim($username);

        if (empty($username)) {
            $message .= " The username field was empty. ";
            return false;
        }

        $words = explode('_', $username);

        /**
         * If array $words doesn't have exactly two elements then fail.
         */
        if (count($words) != 2) {
            $message .= " The username must have two parts separated by an underscore character. ";
            return false;
        }

        $last_word = $words[1];
        $first_word = $words[0];

        /**
         * The first word must be all alphabetical letters.
         */
        $is_all_alpha = ctype_alpha($first_word);
        if (!$is_all_alpha) {
            $message .= " The username's first part must have alphabet characters only. ";
            return false;
        }

        /**
         * The first word must start with an upper case letter.
         */
        $arr_of_chars = str_split($first_word);
        $first_char_as_string = $arr_of_chars[0];
        $is_cap = ctype_upper($first_char_as_string);
        if (!$is_cap) {
            $message .= " The username needs to start with a capital letter. ";
            return false;
        }

        /**
         * That first letter is the only uppercase letter.
         */
        $rest = substr($first_word, 1);
        $is_lower = ctype_lower($rest);
        if (!$is_lower) {
            $message .= " The username's first part has a letter with improper case. ";
            return false;
        }

        /**
         * The first word must be 4 to 9 characters in length.
         */
        $length = strlen($first_word);
        if ($length > 9 || $length < 4) {
            $message .= " The username's first part doesn't have a proper length. ";
            return false;
        }

        /**
         * The second word is numeric two digits long.
         */
        $length_of_second_word = strlen($last_word);
        if ($length_of_second_word != 2) {
            $message .= " The username's second part is not two digits. ";
            return false;
        }
        if (!is_numeric($last_word)) {
            $message .= " The username's second part is not numeric. ";
            return false;
        }

        $username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);

        return true;
    }

    /**
     * @param string $message
     * @param string $password
     * @return bool
     */
    public static function is_password(string &$message, string &$password)
    {
        /**
         * We want to prevent sql injection
         */
        $trimmed = trim($password);
        if (empty($trimmed)) {
            $message .= " The password field is required. ";
            return false;
        }

        /**
         * The length must be 10 to 18 characters long.
         */
        $length = strlen($password);
        if ($length > 18 || $length < 10) {
            $message .= " The length of your password must be 10 to 18 characters. ";
            return false;
        }

        /**
         * It can't have a space character.
         */
        if (strpos($password, ' ')) {
            $message .= " Non-conforming password because it contains space. ";
            return false;
        }

        /**
         * It can't have weird characters.
         */
        if (preg_match('/[\'$?<>=]/', $password)) {
            $message .= " Non-conforming password because it contains one or more disallowed characters. ";
            return false;
        }

        // count how many lowercase, uppercase, and digits are in the password
        $uc = 0;
        $lc = 0;
        $num = 0;
        $other = 0;
        for ($i = 0, $j = strlen($password); $i < $j; $i++) {
            // Get current character
            $char = substr($password, $i, 1);
            // if $char is uppercase
            if (preg_match('/^[[:upper:]]$/', $char)) {
                $uc++;
            } elseif (preg_match('/^[[:lower:]]$/', $char)) {
                // if $char is lowercase
                $lc++;
            } elseif (preg_match('/^[[:digit:]]$/', $char)) {
                // if $char is a numeric digit
                $num++;
            } else {
                $other++;
            }
        }

        $max = $j - 6;
        if ($uc > $max) {
            $message .= " The password has too many upper case characters. ";
            return false;
        }
        if ($lc > $max) {
            $message .= " The password has too many lower case characters. ";
            return false;
        }
        if ($num > $max) {
            $message .= " The password has too many numeric characters. ";
            return false;
        }
        if ($num < 2) {
            $message .= " Your password needs at least two digit. ";
            return false;
        }
        if ($other < 2) {
            $message .= " Your password needs at least two non-alphanumeric characters. ";
            return false;
        }
        if ($other > $max) {
            $message .= " The password has too many special characters. ";
            return false;
        }

        $password = filter_var($password, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);

        return true;
    }
}