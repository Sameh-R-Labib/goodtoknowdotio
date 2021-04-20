<?php

use GoodToKnow\Models\Community;
use GoodToKnow\Models\User;
use GoodToKnow\Models\UserToCommunity;


/**
 * @param string $html
 */
function fix_michelf(string &$html)
{
    // Fix bugs caused by MarkdownExtra
    $bad = array("&amp;amp;", "&amp;lt;");
    $good = array("&amp;", "&lt;");
    $html = str_replace($bad, $good, $html);
}


/**
 * @param mysqli $db
 * @param string $error
 * @param $user_id
 * @return array|bool
 */
function find_communities_of_user(mysqli $db, string &$error, $user_id)
{
    /**
     * The goal of this function is to return a special_community_array.
     * For our purposes here a special_community_array is an associative
     * array which associates each community ID with its community name.
     * This is restricted to ONLY the communities this user belongs to.
     */


    /**
     * Get all the communities for the user.
     */

    $sql = 'SELECT * FROM user_to_community WHERE `user_id`=' . $user_id;

    $array_of_user_to_community_objects = UserToCommunity::find_by_sql($db, $error, $sql);

    if (!$array_of_user_to_community_objects) {

        $error .= " find_communities_of_user() says unexpectedly received No user_to_community_array. ";

        return false;

    }


    /**
     * Build the array I'm looking for.
     */

    $special_community_array = [];

    foreach ($array_of_user_to_community_objects as $object) {

        /**
         * Talking about the right side of the assignment statement First we're getting a Community object.
         */

        $special_community_array[$object->community_id] = Community::find_by_id($db, $error, $object->community_id);

        if (!$special_community_array[$object->community_id]) {

            $error .= " find_communities_of_user() says err_no 20848. ";

            return false;

        }

        /**
         * Then we're getting the community_name from that object.
         */

        $special_community_array[$object->community_id] = $special_community_array[$object->community_id]->community_name;
    }

    return $special_community_array;
}


/**
 * @param mysqli $db
 * @param string $error
 * @param int $user_id
 * @return bool
 */
function enforce_suspension(mysqli $db, string &$error, int $user_id)
{
    /**
     *   1) Determine whether or not the user is suspended per database
     *   2) If the user is suspended log him out and redirect to the page for logging in.
     *   3) Otherwise, return control over to where the function was called.
     */


    // Determine whether or not the user is suspended per database

    $user_object = User::find_by_id($db, $error, $user_id);

    if ($user_object === false) return false;


    // If the user is suspended log him out and redirect to the page for logging in.

    if ($user_object->is_suspended) {

        // The current script stops (we redirect to the Logout route.)

        redirect_to("/ax1/Logout/page");
    }

    // Otherwise, return control over to where the function was called.
    // At this point we've checked and we know the user is not suspended and the function did not bonk-out.

    return true;
}


/**
 *
 */
function kick_out_loggedoutusers()
{
    global $is_logged_in, $sessionMessage;

    if (!$is_logged_in || !empty($sessionMessage)) {
        breakout(' Log back in because your session has expired. ');
    }
}


/**
 *
 */
function kick_out_nonadmins()
{
    global $is_logged_in, $is_admin, $sessionMessage;

    if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
        breakout(' You are not authorized. ');
    }
}


/**
 * @return bool|mysqli
 */
function get_db()
{
    global $sessionMessage;

    $db = db_connect($sessionMessage);

    if (!empty($sessionMessage) || $db === false) {
        breakout(' I was unable to connect to the database. ');
    }

    return $db;
}


/**
 * @param string $newMessage
 */
function breakout(string $newMessage)
{
    global $sessionMessage;

    $_SESSION['message'] = $sessionMessage . $newMessage;
    reset_feature_session_vars();
    redirect_to("/ax1/Home/page");
}

/**
 *
 */
function reset_feature_session_vars()
{
    $_SESSION['saved_str01'] = '';
    $_SESSION['saved_str02'] = '';
    $_SESSION['saved_int01'] = 0;
    $_SESSION['saved_int01'] = 0;
    $_SESSION['saved_arr01'] = [];
}

/**
 * @param string $location
 */
function redirect_to(string $location)
{
// This function takes a string which normally
// goes in a Location header. Then places it in
// a Location header. Then exits the script.
// Although the script has terminated, its output
// will be sent to the browser (including the
// Location header. Output buffering must be set
// to be on for this to work.

    if ($location != NULL) {

        header("Location: {$location}");
        exit;

    }
}


/**
 * @param int $size
 * @return string
 */
function size_as_text(int $size): string
{
    // takes a size in bytes and returns a more use friendly equivalent
    if ($size < 1024) {
        return "{$size} bytes";
    } elseif ($size < 1048576) {
        $size_kb = round($size / 1024);
        return "{$size_kb} KB";
    } else {
        $size_mb = round($size / 1048576, 1);
        return "{$size_mb} MB";
    }
}

/**
 * @param string $error
 * @return bool|mysqli
 */
function db_connect(string &$error)
{
    try {

        $db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        if ($db->connect_error) {

            $error .= ' ' . htmlspecialchars($db->connect_error, ENT_NOQUOTES | ENT_HTML5) . ' ';
            return false;

        }

        $db->set_charset('utf8mb4');

    } catch (\Exception $e) {

        $error .= ' ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
        return false;

    }

    return $db;
}
