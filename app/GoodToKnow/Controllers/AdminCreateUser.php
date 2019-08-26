<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\User;
use GoodToKnow\Models\UserToCommunity;
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

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }

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
         * store a session message and redirect to /ax1/LoginForm/page
         */

        if (!self::is_username($db, $sessionMessage, $submitted_username) ||
            !self::is_password($sessionMessage, $submitted_first_try, $submitted_password) ||
            !self::is_title($sessionMessage, $submitted_title) ||
            !self::is_race($sessionMessage, $submitted_race) ||
            !self::is_date($sessionMessage, $submitted_date)) {

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

    /**
     * @param $message
     * @param string $str01
     * @param string $str02
     * @return bool
     */
    public static function is_password(string &$message, string &$str01, string &$str02)
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

        // count how many lowercase, uppercase, and digits are in the password
        $uc = 0;
        $lc = 0;
        $num = 0;
        $other = 0;
        for ($i = 0, $j = strlen($str01); $i < $j; $i++) {
            // Get current character
            $char = substr($str01, $i, 1);
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

        return true;
    }

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

    /**
     * @param $message
     * @param string $date
     * @return bool
     */
    public static function is_date(string &$message, string &$date)
    {
        /**
         * Trim it.
         * Can't be empty.
         * Must have two forward slashes.
         * Must have 2 digits / 2 digits / 4 digits
         * Must be a valid date.
         */

        $date = trim($date);

        if (empty($date)) {
            $message .= " The date is missing. ";
            return false;
        }

        $number_of_slashes = substr_count($date, '/');
        if ($number_of_slashes != 2) {
            $message .= " You don't have two slashes in date. ";
            return false;
        }

        /**
         * Split date into its parts.
         */
        $words = explode('/', $date);
        $mm = $words[0];
        $dd = $words[1];
        $yyyy = $words[2];

        if (strlen($mm) != 2 || strlen($dd) != 2 || strlen($yyyy) != 4) {
            $message .= " You did not use correct mm/dd/yyyy date format. ";
            return false;
        }

        if (!is_numeric($mm) || !is_numeric($dd) || !is_numeric($yyyy)) {
            $message .= " The date should consist of numeric digits and 2 forward slashes. And, it does not have
            numeric digits! ";
            return false;
        }

        if (!checkdate($words[0], $words[1], $words[2])) {
            $message .= " That's not a valid date. ";
            return false;
        }

        return true;
    }
}