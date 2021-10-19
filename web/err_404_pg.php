<?php
require('../config.php');

/**
 * Directory Separator
 * @var string
 */
define('DIRSEP', DIRECTORY_SEPARATOR);
define('WEB_DIR', PROJ_ROOT . DIRSEP . 'web');
define('VENDOR_DIR', PROJ_ROOT . DIRSEP . 'vendor');


define('VIEWS', PROJ_ROOT . DIRSEP . 'app' . DIRSEP . 'GoodToKnow' . DIRSEP . 'Views');
define('VIEWSINCLUDES', PROJ_ROOT . DIRSEP . 'app' . DIRSEP . 'GoodToKnow' . DIRSEP . 'ViewsIncludes');
define('CONTROLLERHELPERS', PROJ_ROOT . DIRSEP . 'app' . DIRSEP . 'GoodToKnow' . DIRSEP . 'ControllerHelpers');
define('CONTROLLERINCLUDES', PROJ_ROOT . DIRSEP . 'app' . DIRSEP . 'GoodToKnow' . DIRSEP . 'ControllerIncludes');

define('SESSIONMESSAGE', VIEWSINCLUDES . DIRSEP . 'sessionmessage.php');
define('URLOFMOSTRECENTUPLOAD', VIEWSINCLUDES . DIRSEP . 'urlofmostrecentupload.php');
define('COMMUNITIESFORTHISUSER', VIEWSINCLUDES . DIRSEP . 'communitiesforthisuser.php');
define('CURRENTTOPIC', VIEWSINCLUDES . DIRSEP . 'currenttopic.php');
define('LISTTOPICS', VIEWSINCLUDES . DIRSEP . 'listtopics.php');
define('LISTPOSTS', VIEWSINCLUDES . DIRSEP . 'listposts.php');
define('CURRENTPOST', VIEWSINCLUDES . DIRSEP . 'currentpost.php');
define('CONTROLPANELLINK', VIEWSINCLUDES . DIRSEP . 'controlpanellink.php');
define('SENDMESSAGELINK', VIEWSINCLUDES . DIRSEP . 'sendmessagelink.php');
define('LOGINDIVLINK', VIEWSINCLUDES . DIRSEP . 'logindivlink.php');
define('MESSAGETHEAUTHOR', VIEWSINCLUDES . DIRSEP . 'messagetheauthor.php');
define('BREADCRUMBS', VIEWSINCLUDES . DIRSEP . 'breadcrumbs.php');
define('CURRENTCOMMUNITY', VIEWSINCLUDES . DIRSEP . 'currentcommunity.php');
define('TOPOFREGULARPAGE', VIEWSINCLUDES . DIRSEP . 'topofregularpage.php');
define('BOTTOMOFPAGES', VIEWSINCLUDES . DIRSEP . 'bottomofpages.php');
define('COLLAGE', VIEWSINCLUDES . DIRSEP . 'collage.php');
define('TOPFORFORMPAGES', VIEWSINCLUDES . DIRSEP . 'topforformpages.php');
define('TOPBARDIV', VIEWSINCLUDES . DIRSEP . 'topbardiv.php');
define('CBSOFREGULARPAGES', VIEWSINCLUDES . DIRSEP . 'cbsofregularpages.php');
define('FOOTERBAR', VIEWSINCLUDES . DIRSEP . 'footerbar.php');
define('SUBMITABORT', VIEWSINCLUDES . DIRSEP . 'submitabort.php');
define('HEADINGONE', VIEWSINCLUDES . DIRSEP . 'headingone.php');
define('TIMEFORMFIELD', VIEWSINCLUDES . DIRSEP . 'timeformfield.php');
define('TIMEFORMFIELDPREFILLED', VIEWSINCLUDES . DIRSEP . 'timeformfieldprefilled.php');
define('TIMENEXTANDLASTFORMFIELDS', VIEWSINCLUDES . DIRSEP . 'timenextandlastformfields.php');
define('TIMENEXTANDLASTFORMFIELDSPREFILLED', VIEWSINCLUDES . DIRSEP . 'timenextandlastformfieldsprefilled.php');
define('TIMEBOUGHTSOLD', VIEWSINCLUDES . DIRSEP . 'timeboughtsold.php');
define('TIMEBOUGHTSOLDPREFILLED', VIEWSINCLUDES . DIRSEP . 'timeboughtsoldprefilled.php');


// Trick to get PhpStorm not to show as error.
$path3 = VENDOR_DIR . DIRSEP . 'autoload.php';
$path4 = WEB_DIR . DIRSEP . 'functions.php';
require $path3;
require $path4;


$isLoggedIn = false;
include TOPOFREGULARPAGE;
?>

<h1>Error 404
    <small>&nbsp;&nbsp;Please report this.</small>
</h1>
<p>
    <small>unless you followed a stale link on Google.</small>
</p>
<h3><a href="http://<?= $_SERVER['HTTP_HOST'] ?>">Home &laquo; click here</a></h3>

<?php
include BOTTOMOFPAGES;
?>

