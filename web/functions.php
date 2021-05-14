<?php

use GoodToKnow\Models\User;


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
 * @param int $user_id
 * @return bool
 */
function enforce_suspension(mysqli $db, string &$error, int $user_id): bool
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

    /**
     * OUR GOAL: The routes which do NOT present a view must pass on
     * their "to display message" to the next route. There
     * are two types of routes which do NOT present a view:
     *    1. Routes which end in breakout().
     *    2. Routes which end in  redirect_to().
     *
     * Since, breakout() calls redirect_to() we can accomplish OUR GOAL
     * by passing on their "to display message" within redirect_to().
     */
    global $sessionMessage;

    // passing on the "to display message"
    $_SESSION['message'] = $sessionMessage;

    if ($location !== '') {

        header("Location: {$location}");
        exit;

    }
}


/**
 * @param string $newMessage
 */
function breakout(string $newMessage)
{
    /**
     * OUR GOAL: The routes which do NOT present a view must pass on
     * their "to display message" to the next route. There
     * are two types of routes which do NOT present a view:
     *    1. Routes which end in breakout().
     *    2. Routes which end in  redirect_to().
     *
     * Since, breakout() calls redirect_to() we can accomplish OUR GOAL
     * by passing on their "to display message" within redirect_to().
     */
    global $sessionMessage;

    $sessionMessage .= $newMessage;
    reset_feature_session_vars();
    redirect_to("/ax1/Home/page");
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

    } catch (Exception $e) {

        $error .= ' ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
        return false;

    }

    return $db;
}
