<?php
require('../config.php');

/**
 * Directory Separator
 * @var string
 */
define('DIRSEP', DIRECTORY_SEPARATOR);

/**
 * Includes directory
 * @var string
 */
define('LIB_PATH', PROJ_ROOT . DIRSEP . 'includes');

/**
 * Document Root directory for Apache for the project.
 * @var string
 */
define('WEB_DIR', PROJ_ROOT . DIRSEP . 'web');

/**
 * Vendor directory
 * @var string
 */
define('VENDOR_DIR', PROJ_ROOT . DIRSEP . 'vendor');

/**
 * The ViewsIncludes directory
 */
define('VIEWSINCLUDES', PROJ_ROOT . DIRSEP . 'app' . DIRSEP . 'SRLabib' . DIRSEP . 'UnderdogZone' . DIRSEP .
    'ViewsIncludes');

define('TOPMOST', VIEWSINCLUDES . DIRSEP . 'topmost.php');
define('BOTTOMMOST', VIEWSINCLUDES . DIRSEP . 'bottommost.php');


// Trick to get PhpStorm not to show as error.
$path3 = VENDOR_DIR . DIRSEP . 'autoload.php';
$path4 = LIB_PATH . DIRSEP . 'functions.php';
require $path3;
require $path4;


$isLoggedIn = false;
include TOPMOST;
?>
<div class="container-fluid" style="background-color: #FFFFFF; height: 430px">
    <div class="row">
        <section class="col-12 mt-2">
            <h1>Error 404
                <small>&nbsp;&nbsp;Please report this.</small>
            </h1>
            <p>
                <small>unless you followed a stale link on Google.</small>
            </p>
            <h3><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>">Home &laquo; click here</a></h3>
        </section>
    </div><!-- row -->
</div><!-- content container -->
<?php
include BOTTOMMOST;
?>

