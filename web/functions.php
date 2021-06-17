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
 * Overall perspective:
 *  -- kick_out_loggedoutusers is NOT used on the Home page. However, it is used on most of the other pages.
 *  -- If there is no session file then $g->is_logged_in will be null (and thus breakout will happen.)
 *  -- If there is a message then breakout will happen.
 * Breakout just means control is handed over to the Home page.
 * In the case where there is no session file the Home page will log out the user.
 * In the case where there is a message the Home page will show that message.
 */
function kick_out_loggedoutusers()
{
    global $g;

    if (!$g->is_logged_in || !empty($g->message)) {

        breakout(' Log back in because your session has expired. ');

    }
}


/**
 *
 */
function kick_out_nonadmins()
{
    global $g;

    if (!$g->is_logged_in || !$g->is_admin || !empty($g->message)) {

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
     * their "to display message" to the next route.
     *
     * There are two types of routes which do NOT present a view:
     *    1. Routes which end in breakout().
     *    2. Routes which end in  redirect_to().
     *
     * Since, breakout() calls redirect_to() we can accomplish OUR GOAL
     * by passing on their "to display message" within redirect_to().
     */
    global $g;

    // passing on the "to display message"
    $_SESSION['message'] = $g->message;

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
     * their "to display message" to the next route.
     *
     * There are two types of routes which do NOT present a view:
     *    1. Routes which end in breakout().
     *    2. Routes which end in redirect_to().
     *
     * Since, breakout() calls redirect_to() we can accomplish OUR GOAL
     * by passing on their "to display message" within redirect_to().
     */
    global $g;

    $g->message .= $newMessage;
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
    global $g;

    try {

        $g->db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        if ($g->db->connect_error) {

            $g->message .= ' ' . htmlspecialchars($g->db->connect_error, ENT_NOQUOTES | ENT_HTML5) . ' ';
            return false;

        }

        $g->db->set_charset('utf8mb4');

    } catch (Exception $e) {

        $g->message .= ' ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
        return false;

    }

    return $g->db;
}


/**
 * Also see comment for db_connect_if_not_connected().
 *
 * @return bool|mysqli
 */
function get_db()
{
    global $g;

    $g->db = db_connect();

    if (!empty($g->message) || $g->db === false) {

        breakout(' I was unable to connect to the database. ');

    }

    return $g->db;
}

/**
 * We use db_connect_if_not_connected() rather than get_db()
 * when we want redirection upon failure to be to the
 * /ax1/InfiniteLoopPrevent/page page.
 */
function db_connect_if_not_connected()
{
    global $g;

    if (is_null($g->db)) {

        $g->db = db_connect();

        if ($g->db === false) {

            $g->message .= " Failed to connect to the database. ";
            $_SESSION['message'] = $g->message;
            reset_feature_session_vars();
            redirect_to("/ax1/InfiniteLoopPrevent/page");

        }

    }
}
