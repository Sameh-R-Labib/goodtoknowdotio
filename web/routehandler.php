<?php
/**
 * Date: 8/18/18
 * Time: 8:22 PM
 */

use GoodToKnow\Models\AppState;

require(__DIR__ . '/../config.php');

const DIRSEP = DIRECTORY_SEPARATOR;
const WEB_DIR = PROJ_ROOT . DIRSEP . 'web';
const VENDOR_DIR = PROJ_ROOT . DIRSEP . 'vendor';

/**
 * Here I can define constants for the location
 * of the directory for view includes and for
 * the files for view includes.
 */
const VIEWS = PROJ_ROOT . DIRSEP . 'app' . DIRSEP . 'GoodToKnow' . DIRSEP . 'Views';
const VIEWSINCLUDES = PROJ_ROOT . DIRSEP . 'app' . DIRSEP . 'GoodToKnow' . DIRSEP . 'ViewsIncludes';
const CONTROLLERHELPERS = PROJ_ROOT . DIRSEP . 'app' . DIRSEP . 'GoodToKnow' . DIRSEP . 'ControllerHelpers';
const CONTROLLERINCLUDES = PROJ_ROOT . DIRSEP . 'app' . DIRSEP . 'GoodToKnow' . DIRSEP . 'ControllerIncludes';

const SESSIONMESSAGE = VIEWSINCLUDES . DIRSEP . 'sessionmessage.php';
const URLOFMOSTRECENTUPLOAD = VIEWSINCLUDES . DIRSEP . 'urlofmostrecentupload.php';
const COMMUNITIESFORTHISUSER = VIEWSINCLUDES . DIRSEP . 'communitiesforthisuser.php';
const CURRENTTOPIC = VIEWSINCLUDES . DIRSEP . 'currenttopic.php';
const LISTTOPICS = VIEWSINCLUDES . DIRSEP . 'listtopics.php';
const LISTPOSTS = VIEWSINCLUDES . DIRSEP . 'listposts.php';
const CURRENTPOST = VIEWSINCLUDES . DIRSEP . 'currentpost.php';
const CONTROLPANELLINK = VIEWSINCLUDES . DIRSEP . 'controlpanellink.php';
const SENDMESSAGELINK = VIEWSINCLUDES . DIRSEP . 'sendmessagelink.php';
const LOGINDIVLINK = VIEWSINCLUDES . DIRSEP . 'logindivlink.php';
const MESSAGETHEAUTHOR = VIEWSINCLUDES . DIRSEP . 'messagetheauthor.php';
const BREADCRUMBS = VIEWSINCLUDES . DIRSEP . 'breadcrumbs.php';
const CURRENTCOMMUNITY = VIEWSINCLUDES . DIRSEP . 'currentcommunity.php';
const TOPOFREGULARPAGE = VIEWSINCLUDES . DIRSEP . 'topofregularpage.php';
const BOTTOMOFPAGES = VIEWSINCLUDES . DIRSEP . 'bottomofpages.php';
const COLLAGE = VIEWSINCLUDES . DIRSEP . 'collage.php';
const TOPFORFORMPAGES = VIEWSINCLUDES . DIRSEP . 'topforformpages.php';
const TOPBARDIV = VIEWSINCLUDES . DIRSEP . 'topbardiv.php';
const CBSOFREGULARPAGES = VIEWSINCLUDES . DIRSEP . 'cbsofregularpages.php';
const FOOTERBAR = VIEWSINCLUDES . DIRSEP . 'footerbar.php';
const SUBMITABORT = VIEWSINCLUDES . DIRSEP . 'submitabort.php';
const HEADINGONE = VIEWSINCLUDES . DIRSEP . 'headingone.php';
const TIMEFORMFIELD = VIEWSINCLUDES . DIRSEP . 'timeformfield.php';
const TIMEFORMFIELDPREFILLED = VIEWSINCLUDES . DIRSEP . 'timeformfieldprefilled.php';
const TIMENEXTANDLASTFORMFIELDS = VIEWSINCLUDES . DIRSEP . 'timenextandlastformfields.php';
const TIMENEXTANDLASTFORMFIELDSPREFILLED = VIEWSINCLUDES . DIRSEP . 'timenextandlastformfieldsprefilled.php';
const TIMEBOUGHTSOLD = VIEWSINCLUDES . DIRSEP . 'timeboughtsold.php';
const TIMEBOUGHTSOLDPREFILLED = VIEWSINCLUDES . DIRSEP . 'timeboughtsoldprefilled.php';

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

session_start();

$g = new AppState();


/**
 * Default (for runtime of this script) timezone set to the one the user has chosen.
 */
date_default_timezone_set($g->timezone);


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
 * If the URI portion of the URL starts with /ax1 then the value of
 * $_SERVER['PATH_INFO'] will be everything that follows the /ax1 portion of the URI.
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

$method_name = 'page';    // Default method

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
