<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/5/18
 * Time: 4:21 PM
 */

namespace GoodToKnow\Controllers;


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

        /**
         * Variables to work with:
         *   $saved_str01, $_POST['username'], $_POST['first_try'], $_POST['password'],
         *   $_POST['title'], $_POST['race'], $_POST['comment'], $_POST['date'], $_POST['submit']
         */

        /**
         * If any of the submitted fields is invalid
         * then store a session message and redirect to /ax1/LoginForm/page
         */
    }

    public static function is_username(string $username)
    {
        /**
         * Can't be empty.
         * Must consist of two words separated by an underscore.
         * The first word must start with an upper case letter.
         * That first letter is the only uppercase letter.
         * The first word must be 4 to 9 characters in length.
         * The second word is numeric two digits long.
         * The username can't already exist in the database.
         */

    }

    public static function is_password(string $str01, $str02)
    {
        /**
         * Can't be empty.
         * Make sure the two strings match and work as password.
         */
    }

    public static function is_title(string $title)
    {
        /**
         * Can't be empty.
         * Mr and Ms are the only valid values for title.
         */
    }

    public static function is_race(string $race)
    {
        /**
         * Can't be empty.
         * Must be one of the ones I have in the form.
         */
    }

    public static function is_comment(string $comment)
    {
        /**
         * Can't be empty.
         * Must be less than 800 characters long.
         * Can't contain any html tags
         * Can't have any non ascii characters.
         */
    }
}