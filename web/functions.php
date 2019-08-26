<?php

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
function size_as_text(int $size)
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

        $db = new \mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

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
