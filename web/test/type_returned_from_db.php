<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/13/18
 * Time: 12:00 AM
 *
 * I've noticed that some methods of data retrieval from the database
 * preserve the type of the data. But some other methods don't.
 * For example User::authenticate does while UseToCommunity::find_by_sql
 * does not.
 */

require(__DIR__ . '/../../config.php');
define('DIRSEP', DIRECTORY_SEPARATOR);
define('WEB_DIR', PROJ_ROOT . DIRSEP . 'web');
define('VENDOR_DIR', PROJ_ROOT . DIRSEP . 'vendor');
$path3 = VENDOR_DIR . DIRSEP . 'autoload.php';
require $path3;
$path4 = WEB_DIR . DIRSEP . 'functions.php';
require $path4;
$error = '';
$db = db_connect($error);

if (!empty($error)) {
    die("<p>Connection error: {$error}</p>");
}


/**
 * Here I'll use the techniques of User::authenticate
 * to get a UserToCommunity object.
 */
try {
    $sql = 'SELECT * FROM user_to_community WHERE `user_id`= ?';
    $stmt = $db->stmt_init();
    if (!$stmt->prepare($sql)) {
        $error .= $stmt->error . ' ';
        die("<p>Statement preparation error: {$error}</p>");
    } else {
        $user_id = 1;
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $numrows = $result->num_rows;
        if (!$numrows) {
            $stmt->close();
            die("<p>The query on line 44 yielded no results.</p>");
        } else {
            $user_to_community = $result->fetch_object('\GoodToKnow\Models\UserToCommunity');
            $stmt->close();
        }
    }
} catch (\Exception $e) {
    $error .= 'Around line 40 the following exception was thrown: ' .
        htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
}

if (!empty($error)) {
    die("<p>Line 60 says the error string is not empty. It has: {$error}</p>");
}

echo "<p>The object retrieved using prepared the statement way:</p><pre>";
var_dump($user_to_community);
echo "</pre><p>End of part one.</p>";


/**
 * Here I'll use the techniques of UseToCommunity::find_by_sql
 * to get a UserToCommunity object.
 */
$object_array = [];

$sql = 'SELECT * FROM user_to_community WHERE `user_id`= 1';

try {
    $result = $db->query($sql);
    $query_error = $db->error;
    if (!empty($query_error)) {
        $error .= 'The find_by_sql like way failed. The reason given by mysqli is: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5);
        die("<p>Died at line 81 with error: {$error}</p>");
    }
} catch (\Exception $e) {
    $error .= ' Caught a thrown exception around line 78: ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
}

if (!empty($error)) {
    die("<p>Died at line 88 with error: {$error}</p>");
}

while ($row = $result->fetch_assoc()) {
    /*
     * Debug
     *
     * Here is where we can get our first
     * glimpse into the types returned.
     */
    echo "<p>This is the array we get when we do \$result->fetch_assoc(): </p><pre>";
    var_dump($row);
    echo "</pre>";

    $object_array[] = array_to_object($row);
}

$user_to_community = array_shift($object_array);

echo "<p>The object retrieved using find_by_sql way:</p><pre>";
var_dump($user_to_community);
echo "</pre><p>The End.</p>";


// Helpers

function array_to_object(array $array)
{
    $object_in_memory = new \GoodToKnow\Models\UserToCommunity();
    foreach ($array as $key => $value) {
        if (has_attribute($key, $object_in_memory)) {
            $object_in_memory->$key = $value;
        }
    }
    return $object_in_memory;
}

function has_attribute(string $possible_attribute, \GoodToKnow\Models\UserToCommunity $object)
{
    return array_key_exists($possible_attribute, $object->attributes());
}