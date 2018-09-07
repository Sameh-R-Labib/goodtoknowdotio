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
         * I can't assume these post variables exist so I do the following.
         */
        $submitted_username = (isset($_POST['username'])) ? $_POST['username'] : '';
        $submitted_first_try = (isset($_POST['first_try'])) ? $_POST['first_try'] : '';
        $submitted_password = (isset($_POST['password'])) ? $_POST['password'] : '';
        $submitted_title = (isset($_POST['title'])) ? $_POST['title'] : '';
        $submitted_race = (isset($_POST['race'])) ? $_POST['race'] : '';
        $submitted_comment = (isset($_POST['comment'])) ? $_POST['comment'] : '';
        $submitted_date = (isset($_POST['date'])) ? $_POST['date'] : '';
        $submitted_submit = (isset($_POST['submit'])) ? $_POST['submit'] : '';

        /**
         * If any of the submitted fields is invalid
         * then store a session message and redirect to /ax1/LoginForm/page
         */
        if (!self::is_username($db, $sessionMessage, $submitted_username)) {
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        if (!self::is_password($sessionMessage, $submitted_first_try, $submitted_password)) {
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        if (!self::is_title($sessionMessage, $submitted_title)) {
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

    public static function is_password(&$message, string &$str01, string &$str02)
    {
        /**
         * Can't be empty.
         * Make sure the two strings match.
         * The length must be 10 to 18 characters long.
         * It can't have a space character.
         * It can't have weird characters.
         */

        /**
         * It can't be empty. So I will trim it then check if there is anything left.
         */
        $trimmed = trim($str01);
        if (empty($trimmed)) {
            $message .= " The password field is required. ";
            return false;
        }

        /**
         * Make sure the two strings match.
         */
        $are_equal = ($str01 === $str02);
        if (!$are_equal) {
            $message .= " Your two passwords don't match. ";
            return false;
        }

        /**
         * The length must be 10 to 18 characters long.
         */
        $length = strlen($str01);
        if ($length > 18 || $length < 10) {
            $message .= " The length of your password must be 10 to 18 characters. ";
            return false;
        }

        /**
         * It can't have a space character.
         */
        if (strpos($str01, ' ')) {
            $message .= " Non-conforming password because it contains space. ";
            return false;
        }

        /**
         * It can't have weird characters.
         */
        if (preg_match('/[\'$?<>=]/', $str01)) {
            $message .= " Non-conforming password because it contains one or more disallowed characters. ";
            return false;
        }

        return true;
    }

    public static function is_title(&$message, string &$title)
    {
        /**
         * Trim it.
         * Can't be empty.
         * Mr and Ms are the only valid values for title.
         */
        $title = trim($title);

        if (empty($title)) {
            $message .= " Your title is missing. ";
            return false;
        }

        $possible = ['Mr', 'Ms'];
        if (!in_array($title, $possible)) {
            $message .= " Your title field does not contain a valid value. ";
            return false;
        }

        return true;
    }

    public static function is_race(&$message, string &$race)
    {
        /**
         * Trim it.
         * Can't be empty.
         * Must be one of the ones I have in the form.
         */
    }

    public static function is_comment(&$message, string &$comment)
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