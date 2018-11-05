<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/18/18
 * Time: 8:22 PM
 */

require(__DIR__ . '/../config.php');

define('DIRSEP', DIRECTORY_SEPARATOR);
define('WEB_DIR', PROJ_ROOT . DIRSEP . 'web');
define('VENDOR_DIR', PROJ_ROOT . DIRSEP . 'vendor');

/**
 * Here I can define constants for the location
 * of the directory for view includes and for
 * the files for view includes.
 */
define('VIEWS', PROJ_ROOT . DIRSEP . 'app' . DIRSEP . 'GoodToKnow' . DIRSEP . 'Views');
define('VIEWSINCLUDES', PROJ_ROOT . DIRSEP . 'app' . DIRSEP . 'GoodToKnow' . DIRSEP . 'ViewsIncludes');

define('TOP', VIEWSINCLUDES . DIRSEP . 'top.php');
define('BOTTOM', VIEWSINCLUDES . DIRSEP . 'bottom.php');
define('SESSIONMESSAGE', VIEWSINCLUDES . DIRSEP . 'sessionmessage.php');
define('COMMUNITIESFORTHISUSER', VIEWSINCLUDES . DIRSEP . 'communitiesforthisuser.php');
define('CURRENTTOPIC', VIEWSINCLUDES . DIRSEP . 'currenttopic.php');
define('LISTTOPICS', VIEWSINCLUDES . DIRSEP . 'listtopics.php');
define('LISTPOSTS', VIEWSINCLUDES . DIRSEP . 'listposts.php');
define('CURRENTPOST', VIEWSINCLUDES . DIRSEP . 'currentpost.php');
define('CONTROLPANELLINK', VIEWSINCLUDES . DIRSEP . 'controlpanellink.php');
define('SENDMESSAGELINK', VIEWSINCLUDES . DIRSEP . 'sendmessagelink.php');
define('MESSAGETHEAUTHOR', VIEWSINCLUDES . DIRSEP . 'messagetheauthor.php');

/**
 * More require statements
 */
$path3 = VENDOR_DIR . DIRSEP . 'autoload.php';
$path4 = WEB_DIR . DIRSEP . 'functions.php';
require $path3;
require $path4;

// Define Stripe Keys
//if (ENVIRONMENT == 'development') {
//    $myStripePubKey = TESTSTRIPEPUB;
//    $myStripeSecKey = TESTSTRIPESEC;
//} elseif (ENVIRONMENT == 'production') {
//    $myStripePubKey = LIVESTRIPEPUB;
//    $myStripeSecKey = LIVESTRIPESEC;
//} else {
//    die('I do not know which environment I am in.');
//}

/**
 * Before we call the controller method
 * let us gather some knowledge from
 * the session and put it into variables
 * which have friendly names.
 */
session_start();

$sessionMessage = (isset($_SESSION['message'])) ? $_SESSION['message'] : '';
$_SESSION['message'] = '';

$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 0;

$user_username = (isset($_SESSION['user_username'])) ? $_SESSION['user_username'] : '';

$role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '';

$community_id = (isset($_SESSION['community_id'])) ? $_SESSION['community_id'] : 0;

$community_name = (isset($_SESSION['community_name'])) ? $_SESSION['community_name'] : '';

$community_description = (isset($_SESSION['community_description'])) ? $_SESSION['community_description'] : '';

/**
 * communities for this user
 *
 * The structure of that associative array:
 *  - Key   is a community id
 *  - Value is a community name
 */
$special_community_array = (isset($_SESSION['special_community_array'])) ? $_SESSION['special_community_array'] : [];

$topic_id = (isset($_SESSION['topic_id'])) ? $_SESSION['topic_id'] : 0;

$topic_name = (isset($_SESSION['topic_name'])) ? $_SESSION['topic_name'] : '';

$post_id = (isset($_SESSION['post_id'])) ? $_SESSION['post_id'] : 0;

$post_name = (isset($_SESSION['post_name'])) ? $_SESSION['post_name'] : '';

$type_of_resource_requested = (isset($_SESSION['type_of_resource_requested'])) ? $_SESSION['type_of_resource_requested'] : '';

$special_topic_array = (isset($_SESSION['special_topic_array'])) ? $_SESSION['special_topic_array'] : [];

$special_post_array = (isset($_SESSION['special_post_array'])) ? $_SESSION['special_post_array'] : [];

$last_refresh_communities = (isset($_SESSION['last_refresh_communities'])) ? $_SESSION['last_refresh_communities'] : 0;

$last_refresh_topics = (isset($_SESSION['last_refresh_topics'])) ? $_SESSION['last_refresh_topics'] : 0;

$last_refresh_posts = (isset($_SESSION['last_refresh_posts'])) ? $_SESSION['last_refresh_posts'] : 0;

$last_refresh_posts = (isset($_SESSION['last_refresh_content'])) ? $_SESSION['last_refresh_content'] : 0;

$post_content = (isset($_SESSION['post_content'])) ? $_SESSION['post_content'] : '';

$author_username = (isset($_SESSION['author_username'])) ? $_SESSION['author_username'] : '';

$author_id = (isset($_SESSION['author_id'])) ? $_SESSION['author_id'] : 0;

$saved_str01 = (isset($_SESSION['saved_str01'])) ? $_SESSION['saved_str01'] : '';

$saved_str02 = (isset($_SESSION['saved_str02'])) ? $_SESSION['saved_str02'] : '';

$saved_int01 = (isset($_SESSION['saved_int01'])) ? $_SESSION['saved_int01'] : null;

$saved_int02 = (isset($_SESSION['saved_int02'])) ? $_SESSION['saved_int02'] : null;

$is_logged_in = (!empty($user_id)) ? true : false;

$is_admin = ($role === 'admin') ? true : false;


/**
 * Temporary development values
 */


/**
 * Section Description:
 * HERE WE DETERMINE WHICH CONTROLLER
 *                   WHICH METHOD
 *                   WHAT PARAMETERS TO PASS TO THE METHOD
 * AND THEN WE CALL THIS METHOD GIVING IT THE PARAMETERS
 * WE DETERMINE ALL THIS BASED ON THE ROUTE SPECIFIED
 * BY THE HTTP REQUEST
 */

/**
 * An array of the segments supplied
 * by the user in the HTTP request
 */
$route_segments_array = [];

/**
 * $_SERVER['PATH_INFO']
 * If the URI portion of the URL starts with /# then the value of
 * $_SERVER['PATH_INFO'] will be everything that follows the /# portion of the URI.
 */

if (!empty($_SERVER['PATH_INFO'])) {
    $route = rtrim($_SERVER['PATH_INFO'], '/ ');
    $route = ltrim($route, '/');
    // The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
    // This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=
    $route = filter_var($route, FILTER_SANITIZE_URL);
    $route_segments_array = explode('/', $route);
}

/**
 * Figure out which controller
 * and instantiate its object
 */

$controller_name = 'Home';    // Default controller

if (!empty($route_segments_array[0])) {
    $file_path_to_controller = PROJ_ROOT . DIRSEP . 'app' . DIRSEP . 'GoodToKnow' . DIRSEP . 'Controllers' . DIRSEP .
        "{$route_segments_array[0]}.php";
    if (file_exists($file_path_to_controller)) {
        $controller_name = $route_segments_array[0];
        unset($route_segments_array[0]);
    }
}

$fully_qualified_controller_name = 'GoodToKnow\Controllers\\' . $controller_name;

$controller_object = new $fully_qualified_controller_name;

/**
 * Figure out which method
 * and call it
 */

$method_name = 'page';

if (!empty($route_segments_array[1])) {
    if (method_exists($controller_object, $route_segments_array[1])) {
        $method_name = $route_segments_array[1];
        unset($route_segments_array[1]);
    }
}

$parameters_array = [];

if (!empty($route_segments_array)) {
    $parameters_array = array_values($route_segments_array);
}

call_user_func_array([$controller_object, $method_name], $parameters_array);
