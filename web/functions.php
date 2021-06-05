<?php

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
 *
 */
function kick_out_loggedoutusers()
{
    global $app_state;

    if (!$app_state->is_logged_in || !empty($app_state->message)) {

        breakout(' Log back in because your session has expired. ');

    }
}


/**
 *
 */
function kick_out_nonadmins()
{
    global $is_admin, $app_state;

    if (!$app_state->is_logged_in || !$is_admin || !empty($app_state->message)) {

        breakout(' You are not authorized. ');

    }
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
    global $app_state;

    // passing on the "to display message"
    $_SESSION['message'] = $app_state->message;

    if ($location !== '') {

        header("Location: $location");
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
    global $app_state;

    $app_state->message .= $newMessage;
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

        return "$size bytes";

    } elseif ($size < 1048576) {

        $size_kb = round($size / 1024);
        return "$size_kb KB";

    } else {

        $size_mb = round($size / 1048576, 1);
        return "$size_mb MB";

    }
}


/**
 * @return bool|mysqli
 */
function db_connect()
{
    global $app_state;

    try {

        $db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        if ($db->connect_error) {

            $app_state->message .= ' ' . htmlspecialchars($db->connect_error, ENT_NOQUOTES | ENT_HTML5) . ' ';
            return false;

        }

        $db->set_charset('utf8mb4');

    } catch (Exception $e) {

        $app_state->message .= ' ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
        return false;

    }

    return $db;
}


/**
 * @return bool|mysqli
 */
function get_db()
{
    global $app_state;

    $db = db_connect();

    if (!empty($app_state->message) || $db === false) {

        breakout(' I was unable to connect to the database. ');

    }

    return $db;
}
