<?php
require('../config.php');
require('constant_definitions.php');


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

