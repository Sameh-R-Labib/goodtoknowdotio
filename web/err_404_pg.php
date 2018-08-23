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

define('TOP', VIEWSINCLUDES . DIRSEP . 'top.php');
define('BOTTOM', VIEWSINCLUDES . DIRSEP . 'bottom.php');


// Trick to get PhpStorm not to show as error.
$path3 = VENDOR_DIR . DIRSEP . 'autoload.php';
$path4 = WEB_DIR . DIRSEP . 'functions.php';
require $path3;
require $path4;


$isLoggedIn = false;
include TOP;
?>

<h1>Error 404
    <small>&nbsp;&nbsp;Please report this.</small>
</h1>
<p>
    <small>unless you followed a stale link on Google.</small>
</p>
<h3><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>">Home &laquo; click here</a></h3>

<?php
include BOTTOM;
?>

