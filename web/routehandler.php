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

/**
 * Before we call the controller method
 * let us gather some knowledge from
 * the session and put it into variables
 * which have friendly names.
 */
session_start();

// The "to display message" is handled DIFFERENTLY. Whereas the rest of the state's
// variables get to be completely expunged via a call to reset_feature_session_vars() during a breakout(),
// the "to display message" needs to be expunged from existence when execution results in a view being presented.
// That is why, "right here", we do "$_SESSION['message'] = '';". We could have expunged the message
// directly before presenting the view; however, I chose to do it now. And, as a consequence this design decision
// we end up needing to explicitly transfer the message during redirections. My point is that the  "to display message"
// is handled DIFFERENTLY from other state variables.
//
// The reason we go through the trouble of handling the "to display message" this way is to
// PREVENT AN ANOMALY
// from happening IF our server should crash. The session file may survive a server crash; and, if it does, then
// "the message" would survive the server crash. And, that's undesirable. On the other hand it's not a big deal if
// the other state variables survive a server crash because we're only deleting them to save disc space.
//$app_state->message = (isset($_SESSION['message'])) ? $_SESSION['message'] : '';
//$_SESSION['message'] = '';


$app_state = new AppState();


//$url_of_most_recent_upload = (isset($_SESSION['url_of_most_recent_upload'])) ? $_SESSION['url_of_most_recent_upload'] : '';

//$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 0;

//$user_username = (isset($_SESSION['user_username'])) ? $_SESSION['user_username'] : '';

//$role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '';

//$timezone = (isset($_SESSION['timezone'])) ? $_SESSION['timezone'] : 'America/New_York';

//$community_id = (isset($_SESSION['community_id'])) ? $_SESSION['community_id'] : 0;

//$community_name = (isset($_SESSION['community_name'])) ? $_SESSION['community_name'] : '';

//$community_description = (isset($_SESSION['community_description'])) ? $_SESSION['community_description'] : '';

/**
 * communities for this user
 *
 * The structure of that associative array:
 *  - Key   is a community id
 *  - Value is a community name
 */
//$special_community_array = (isset($_SESSION['special_community_array'])) ? $_SESSION['special_community_array'] : [];

//$topic_id = (isset($_SESSION['topic_id'])) ? $_SESSION['topic_id'] : 0;

$topic_name = (isset($_SESSION['topic_name'])) ? $_SESSION['topic_name'] : '';

$topic_description = (isset($_SESSION['topic_description'])) ? $_SESSION['topic_description'] : '';

$post_id = (isset($_SESSION['post_id'])) ? $_SESSION['post_id'] : 0;

$post_name = (isset($_SESSION['post_name'])) ? $_SESSION['post_name'] : '';

$post_full_name = (isset($_SESSION['post_full_name'])) ? $_SESSION['post_full_name'] : '';

$type_of_resource_requested = (isset($_SESSION['type_of_resource_requested'])) ? $_SESSION['type_of_resource_requested'] : '';

$special_topic_array = (isset($_SESSION['special_topic_array'])) ? $_SESSION['special_topic_array'] : [];

$special_post_array = (isset($_SESSION['special_post_array'])) ? $_SESSION['special_post_array'] : [];

$last_refresh_communities = (isset($_SESSION['last_refresh_communities'])) ? $_SESSION['last_refresh_communities'] : 1554825315;

$last_refresh_topics = (isset($_SESSION['last_refresh_topics'])) ? $_SESSION['last_refresh_topics'] : 1554825315;

$last_refresh_posts = (isset($_SESSION['last_refresh_posts'])) ? $_SESSION['last_refresh_posts'] : 1554825315;

$last_refresh_posts = (isset($_SESSION['last_refresh_content'])) ? $_SESSION['last_refresh_content'] : 1554825315;

$post_content = (isset($_SESSION['post_content'])) ? $_SESSION['post_content'] : '';

$author_username = (isset($_SESSION['author_username'])) ? $_SESSION['author_username'] : '';

$author_id = (isset($_SESSION['author_id'])) ? $_SESSION['author_id'] : 0;

$when_last_checked_suspend = (isset($_SESSION['when_last_checked_suspend'])) ? $_SESSION['when_last_checked_suspend'] : 1554825315;

$messages_last_quantity = (isset($_SESSION['messages_last_quantity'])) ? $_SESSION['messages_last_quantity'] : null;

$messages_last_time = (isset($_SESSION['messages_last_time'])) ? $_SESSION['messages_last_time'] : null;

$saved_str01 = (isset($_SESSION['saved_str01'])) ? $_SESSION['saved_str01'] : '';

$saved_str02 = (isset($_SESSION['saved_str02'])) ? $_SESSION['saved_str02'] : '';

$saved_int01 = (isset($_SESSION['saved_int01'])) ? $_SESSION['saved_int01'] : 0;

$saved_int02 = (isset($_SESSION['saved_int02'])) ? $_SESSION['saved_int02'] : 0;

$saved_arr01 = (isset($_SESSION['saved_arr01'])) ? $_SESSION['saved_arr01'] : [];

$is_logged_in = !empty($app_state->user_id);

$is_admin = $app_state->role === 'admin';

$is_guest = false;  // Set this here so we don't need to check to see if $is_guest is set.

/**
 * The strategy is for vars used in views to be declared global both
 * in the view file and in the view's controller class method. To round things
 * off we will also initialize the vars "not initialized above" below.
 *
 * Also, it's good to make global the vars which traverse multiple include files.
 * For example $message_object.
 */
$page = 'Home';
$html_title = '';
$long_title_of_post = '';
$pre_populate = '';
$array = [];
$markdown = '';
$coms_user_belongs_to = [];
$coms_user_does_not_belong_to = [];
$show_poof = false;
$time_bought = [];
$time_sold = [];
$time = [];
$last = [];
$next = [];
$object = '';
$community_object = null;
$message_object = null;
$topic_object = null;
$bitcoin_object = null;
$user_object = null;
$recurring_payment_object = null;
$thing_type = '';
$thing_name = '';
$result = '';
$fields = '';
$present = '';
$array_of_post_objects = [];
$array_of_author_usernames = [];
$array_of_recurring_payment_objects = [];
$array_of_bitcoin_objects = [];
$array_of_objects = [];
$inbox_messages_array = [];
$readable_user_objects_array = [];
$submitted_community_ids_array = [];
$community_array = [];
$account = '';
$account_type = '';
$bank = '';
$chosen_topic_id = 0;
$price_bought = 0;
$price_sold = 0;
$currency_transacted = '';
$commodity_amount = 0;
$commodity_type = '';
$commodity_label = '';
$tax_year = 0;
$profit = 0;

/**
 * Various initializations.
 */
$db = 'not connected';


/**
 * Default (for runtime of this script) timezone set to the one the user has chosen.
 */
date_default_timezone_set($app_state->timezone);


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
