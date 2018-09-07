<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/5/18
 * Time: 4:21 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\User;


class AdminCreateUser
{
    public function page()
    {

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;
        global $user_id;
        global $role;
        global $community_name;
        global $community_id;
        global $community_array;
        global $topic_id;
        global $page_id;
        global $saved_str01; // choice
        global $saved_str02;

        if (!$is_logged_in OR !$is_admin) {
            $_SESSION['message'] = $sessionMessage; // to pass message along since script doesn't output anything
            redirect_to("/ax1/LoginForm/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * Variables to work with:
         *   $saved_str01, $_POST['username'], $_POST['first_try'], $_POST['password'],
         *   $_POST['title'], $_POST['race'], $_POST['comment'], $_POST['date'], $_POST['submit']
         */

        /**
         * If any of the submitted fields is invalid
         * then store a session message and redirect to /ax1/LoginForm/page
         */
        if (!self::is_username($db, $sessionMessage, $_POST['username'])) {
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * Make use of the fact that some validation functions update $sessionMessage.
         */

        /**
         * Store user.
         */

        /**
         * Store association between user and community.
         */
    }

    /**
     * @param \mysqli $db
     * @param string $message
     * @param string $username
     * @return bool
     */
    public static function is_username(\mysqli $db, string &$message, string &$username)
    {
        /**
         * Trim it.
         * Can't be empty.
         * Must consist of two words separated by an underscore.
         * The first word must start with an upper case letter.
         * That first letter is the only uppercase letter.
         * The first word must be 4 to 9 characters in length.
         * The second word is numeric two digits long.
         * The username can't already exist in the database.
         */

        $username = trim($username);

        if (empty($username)) {
            return false;
        }

        $words = explode('_', $username);

        /**
         * If array $words doesn't have exactly two elements then fail.
         */
        if (count($words) != 2) {
            return false;
        }

        $last_word = $words[1];
        $first_word = $words[0];

        /**
         * The first word must be all alphabetical letters.
         */
        $is_all_alpha = ctype_alpha($first_word);
        if (!$is_all_alpha) {
            return false;
        }

        /**
         * The first word must start with an upper case letter.
         */
        $arr_of_chars = str_split($first_word);
        $first_char_as_string = $arr_of_chars[0];
        $is_cap = ctype_upper($first_char_as_string);
        if (!$is_cap) {
            return false;
        }

        /**
         * That first letter is the only uppercase letter.
         */
        $rest = substr($first_word, 1);
        $is_lower = ctype_lower($rest);
        if (!$is_lower) {
            return false;
        }

        /**
         * The first word must be 4 to 9 characters in length.
         */
        $length = strlen($first_word);
        if ($length > 9 || $length < 4) {
            return false;
        }

        /**
         * The second word is numeric two digits long.
         */
        $length_of_second_word = strlen($last_word);
        if ($length_of_second_word != 2) {
            return false;
        }
        if (!is_numeric($last_word)) {
            return false;
        }

        /**
         * The username can't already exist in the database.
         */
        $is_in_use = User::is_taken_username($db, $message, $username);
        if ($is_in_use) {
            $message .= " The username is taken. Find a different one and try again. ";
            return false;
        }

        return true;
    }

    public static function is_password(string &$str01, &$str02)
    {
        /**
         * Trim it.
         * Can't be empty.
         * Make sure the two strings match and work as password.
         */
    }

    public static function is_title(string &$title)
    {
        /**
         * Trim it.
         * Can't be empty.
         * Mr and Ms are the only valid values for title.
         */
    }

    public static function is_race(string &$race)
    {
        /**
         * Trim it.
         * Can't be empty.
         * Must be one of the ones I have in the form.
         */
    }

    public static function is_comment(string &$comment)
    {
        /**
         * Trim it.
         * Can't be empty.
         * Must be less than 800 characters long.
         * Can't contain any html tags
         * Can't have any non ascii characters.
         */
    }
}