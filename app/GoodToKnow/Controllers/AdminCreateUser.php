<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/5/18
 * Time: 4:21 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\User;
use GoodToKnow\Models\UserToCommunity;


class AdminCreateUser
{
    /**
     *
     */
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
//        $submitted_submit = (isset($_POST['submit'])) ? $_POST['submit'] : '';

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
            !self::is_comment($sessionMessage, $submitted_comment) ||
            !self::is_date($sessionMessage, $submitted_date)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * So far so good!
         */

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
            'id_of_default_community' => $saved_str01,
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
            $sessionMessage .= ' The save method for User returned false. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        if (!empty($sessionMessage)) {
            $sessionMessage .= ' The save method for User did not return false but it did send back a message.
             Therefore, it probably did not create your account. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * Store association between user and community.
         */
        // The three steps again
        $array_of_user_to_community_row_data = ['user_id' => $new_user_object->id, 'community_id' => $saved_str01];

        $new_user_to_community_object = UserToCommunity::array_to_object($array_of_user_to_community_row_data);

        $consequence_of_save = $new_user_to_community_object->save($db, $sessionMessage);

        if (!$consequence_of_save) {
            $sessionMessage .= ' The save method for UserToCommunity returned false. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        if (!empty($sessionMessage)) {
            $sessionMessage .= ' The save method for UserToCommunity did not return false but it did send back a message.
             Therefore, it probably did not create the association for your account. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * Assumed success.
         * Set $sessionMessage and redirect.
         */
        $sessionMessage .= " The new user account was created! ";
        $_SESSION['message'] = $sessionMessage;
        redirect_to("/ax1/LoginForm/page");
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

    /**
     * @param $message
     * @param string $race
     * @return bool
     */
    public static function is_race(&$message, string &$race)
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
     * @param string $comment
     * @return bool
     */
    public static function is_comment(&$message, string &$comment)
    {
        /**
         * Trim it.
         * Can't be empty.
         * Must be less than 800 characters long.
         * Can't contain any html tags
         * Can't have any non ascii characters.
         */
        $comment = trim($comment);

        if (empty($comment)) {
            $message .= " Your comment is missing. ";
            return false;
        }

        $length = strlen($comment);
        if ($length > 800) {
            $message .= " Your comment is too long. ";
            return false;
        }

        if ($comment != strip_tags($comment)) {
            $message .= " Your comment includes html. We don't allow that in this field. ";
            return false;
        }

        if (!mb_detect_encoding($comment, 'ASCII', true)) {
            $message .= " Your comment includes one or more non ascii characters. We don't allow that in this field. ";
            return false;
        }

        return true;
    }

    /**
     * @param $message
     * @param string $date
     * @return bool
     */
    public static function is_date(&$message, string &$date)
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