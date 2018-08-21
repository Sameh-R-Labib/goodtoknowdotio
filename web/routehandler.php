<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/18/18
 * Time: 8:22 PM
 */

use \GoodToKnow\Controllers\FrontController;

require(__DIR__ . '/../config.php');

define('DIRSEP', DIRECTORY_SEPARATOR);
define('WEB_DIR', PROJ_ROOT . DIRSEP . 'web');
define('VENDOR_DIR', PROJ_ROOT . DIRSEP . 'vendor');

/**
 * Here I can define constants for the location
 * of the directory for view includes and for
 * the files for view includes.
 */
define('VIEWSINCLUDES', PROJ_ROOT . DIRSEP . 'app' . DIRSEP . 'GoodToKnow' . DIRSEP . 'ViewsIncludes');

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
 * Major Section Title
 * HERE WE DETERMINE WHICH CONTROLLER
 *                   WHICH METHOD
 *                   WHAT PARAMETERS TO PASS TO THE METHOD
 * AND THEN WE CALL THIS METHOD GIVING IT THE PARAMETERS
 * WE DETERMINE ALL THIS BASED ON THE ROUTE SPECIFIED
 * BY THE HTTP REQUEST
 */
