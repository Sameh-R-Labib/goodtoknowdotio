<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-01-08
 * Time: 20:25
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\User;


class GiveComsToUsrProcessor
{
    public function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Goal:
         *  1) Validate $_POST['username']
         *  2) Save $_POST['username']
         *  3) Redirect to a route which will present a form with checkboxes for choosing communities
         */

        $submitted_username = (isset($_POST['username'])) ? $_POST['username'] : '';

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $is_username = self::is_username_in_our_system($db, $sessionMessage, $submitted_username);

        if (!$is_username) {
            $sessionMessage .= " The username is not valid. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_str01'] = $submitted_username;

        redirect_to("/ax1/GiveComsChoices/page");
    }

    // Helpers for the page() method

    /**
     * @param \mysqli $db
     * @param string $message
     * @param string $username
     * @return bool
     */
    public static function is_username_in_our_system(\mysqli $db, string &$message, string &$username)
    {
        /**
         * Returns true or false.
         *
         * First makes sure it fits the pattern of a username.
         * Then, makes sure the username exists in the database.
         */

        $username = trim($username);

        if (empty($username)) {
            $message .= " The username field was empty. ";
            return false;
        }

        $words = explode('_', $username);

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
         * The username must already exist in the database.
         */
        $is_in_use = User::is_taken_username($db, $message, $username);
        if (!$is_in_use) {
            $message .= " The username could not be found. ";
            return false;
        }

        return true;
    }
}