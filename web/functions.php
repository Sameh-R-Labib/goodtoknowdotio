<?php

use GoodToKnow\Models\status;

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
 * @return void
 */
function offline_enforcement()
{
    global $g;

    $elapsed_time = time() - $g->when_last_checked_system_status_offline;

    if ($elapsed_time > 400 and !$g->is_admin) {

        /**
         * Enforce offline status.
         */

        $g->when_last_checked_system_status_offline = time();

        $_SESSION['when_last_checked_system_status_offline'] = $g->when_last_checked_system_status_offline;

        db_connect_if_not_connected();


        /**
         * Get the system status object.
         */

        $status_object = status::find_by_id(1);

        if (!$status_object) {

            breakout(' ERROR: 581471547. ');

        }

        if ($status_object->name !== 'normal' and $status_object->name !== 'offline') {

            breakout(' ERROR: 1471 The status name is invalid. ');

        }

        if ($status_object->message !== 'The system is operating with normal status.' and
            $status_object->message !== 'The system is operating with offline status.') {

            breakout(' ERROR: 1471 The status message is invalid. ');

        }


        /**
         * Kick out the user.
         */

        if ($status_object->name == 'offline') {

            redirect_to("/ax1/logout/page");

        }
    }
}


/**
 * Gtk.io uses this particular kick out function for
 * Read / Show features because these features may
 * carry over a message from the feature which may
 * have run before it.
 *
 * @return void
 */
function kick_out_loggedoutusers()
{
    global $g;

    if (!$g->is_logged_in or $_SESSION['agree_to_tos'] !== 'agree') {

        breakout(' Either your session has expired or you did not agree to the T.O.S. ');

    }

    offline_enforcement();
}


/**
 * Overall perspective:
 *  -- kick_out_loggedoutusers_or_if_there_is_error_msg is NOT used on the home page. However, it is used on most of the other pages.
 *  -- If there is no session file then $g->is_logged_in will be null (and thus breakout will happen.)
 *  -- If there is a message then breakout will happen.
 * Breakout just means control is handed over to the home page.
 * In the case where there is no session file the home page will log out the user.
 * In the case where there is a message the home page will show that message.
 *
 * Also: offline_enforcement().
 */
function kick_out_loggedoutusers_or_if_there_is_error_msg()
{
    global $g;

    if (!$g->is_logged_in || !empty($g->message) || $_SESSION['agree_to_tos'] !== 'agree') {

        breakout(' Either your session expired or an error message was generated. ');

    }

    offline_enforcement();
}


/**
 *
 */
function kick_out_nonadmins_or_if_there_is_error_msg()
{
    global $g;

    if (!$g->is_logged_in || !$g->is_admin || !empty($g->message) || $_SESSION['agree_to_tos'] !== 'agree') {

        breakout(' Either you\'re not authorized, your session expired, there\'s an error message, or you didn\'t agree to the T.O.S. ');

    }
}


/**
 *
 */
function reset_feature_session_vars()
{
    // We are doing this in case user chooses to abort. If he chooses to abort
    // then we won't get the opportunity to do this while the form is being processed.

    $_SESSION['is_first_attempt'] = true;


    $_SESSION['saved_str01'] = '';
    $_SESSION['saved_str02'] = '';
    $_SESSION['saved_int01'] = 0;
    $_SESSION['saved_int02'] = 0;
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
     *    2. Routes which end in redirect_to().
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
    redirect_to("/ax1/home/page");
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

    if ($g->db === false) {

        breakout(' I was unable to connect to the database. ');

    }

    return $g->db;
}

/**
 * We use db_connect_if_not_connected() rather than get_db()
 * when we:
 *  A. want redirection upon failure to be to /ax1/infinite_loop_prevent/page.
 *  B. want to connect ONLY IF we don't already have a connection.
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
            redirect_to("/ax1/infinite_loop_prevent/page");

        }

    }
}
