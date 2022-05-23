<?php
require('../config.php');

/**
 * Directory Separator
 * @var string
 */
const DIRSEP = DIRECTORY_SEPARATOR;
const WEB_DIR = PROJ_ROOT . DIRSEP . 'web';
const VENDOR_DIR = PROJ_ROOT . DIRSEP . 'vendor';


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
const ABORT = VIEWSINCLUDES . DIRSEP . 'abort.php';
const HEADINGONE = VIEWSINCLUDES . DIRSEP . 'headingone.php';
const TIMEFORMFIELD = VIEWSINCLUDES . DIRSEP . 'timeformfield.php';
const TIMENEXTANDLASTFORMFIELDS = VIEWSINCLUDES . DIRSEP . 'timenextandlastformfields.php';
const TIMENEXTANDLASTFORMFIELDSPREFILLED = VIEWSINCLUDES . DIRSEP . 'timenextandlastformfieldsprefilled.php';
const TIMEBOUGHTSOLD = VIEWSINCLUDES . DIRSEP . 'timeboughtsold.php';


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
<h3><a href="http://<?= $_SERVER['HTTP_HOST'] ?>">home &laquo; click here</a></h3>

<?php
include BOTTOMOFPAGES;
?>

