<?php
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
//function size_as_text(int $size)
//{
//    // takes a size in bytes and returns a more use friendly equivalent
//    if ($size < 1024) {
//        return "{$size} bytes";
//    } elseif ($size < 1048576) {
//        $size_kb = round($size / 1024);
//        return "{$size_kb} KB";
//    } else {
//        $size_mb = round($size / 1048576, 1);
//        return "{$size_mb} MB";
//    }
//}

/**
 * @param string $error
 * @return mysqli
 */
function db_connect(string &$error)
{
    try {
        $db = new \mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if ($db->connect_error) {
            $error .= ' ' . $db->connect_error . ' ';
        }
        $db->set_charset('utf8');
    } catch (\Exception $e) {
        $error .= ' ' . htmlentities($e->getMessage(), ENT_QUOTES | ENT_HTML5) . ' ';
    }
    return $db;
}
