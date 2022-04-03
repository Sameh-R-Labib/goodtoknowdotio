<?php
/**
 * Date: 8/18/18
 * Time: 8:22 PM
 */

use GoodToKnow\Models\app_state;


require(__DIR__ . '/../config.php');

require('constant_definitions.php');

require VENDOR_DIR . DIRSEP . 'autoload.php';
require WEB_DIR . DIRSEP . 'functions.php';


/**
 * The commented out code you see below is
 * just a template for what you would want
 * to put in the config.php you see above
 * if you were to be using Stripe as a payment
 * processor.
 */
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
 * session_start() needs to be near the top of our script
 * so that its builtin cookie and header output will make
 * it into the output buffer of the http response.
 */

session_start();


/**
 * $g is an object container for vars used throughout
 * our response code. Having $g facilitates moving
 * all these vars around -- so, we don't have to declare
 * these vars separately as globals within many include
 * files and function definitions.
 */

$g = new app_state();


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
 * Figure out which controller and instantiate its object
 */


// Default controller

$controller_name = 'home';


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
