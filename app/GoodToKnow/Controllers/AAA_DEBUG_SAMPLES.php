<?php
/**
 * Debug Code
 */
echo "\n\n<p>Begin debug code output.</p>\n\n";
echo "\n\n<p>Var_dump of \$_POST array: </p>\n\n";
echo "\n\n<pre>";
var_dump($_POST);
echo "</pre>\n\n";
echo "\n\n<p>Print_r of \$_POST array: </p>\n\n";
echo "\n\n<pre>";
print_r($_POST);
echo "</pre>\n\n";
//die("\n\n<p>End of debug code output.</p>\n\n");


/**
 * Debug Code
 */
echo "\n\n<p>Begin debug code output.</p>\n\n";
echo "\n\n<p>Var_dump of \$: </p>\n\n";
echo "\n\n<pre>";
var_dump();
echo "</pre>\n\n";
echo "\n\n<p>Print_r of \$: </p>\n\n";
echo "\n\n<pre>";
print_r();
echo "</pre>\n\n";
die("\n\n<p>End of debug code output.</p>\n\n");