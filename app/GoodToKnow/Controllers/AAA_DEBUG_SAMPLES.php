<?php
/**
 * Debug Code
 */
echo "\n\n<p>Begin debug</p>\n\n";
echo "\n\n<p>Var_dump \$_POST array: </p>\n\n";
echo "\n\n<pre>";
var_dump($_POST);
echo "</pre>\n\n";
echo "\n\n<p>Print_r \$_POST array: </p>\n\n";
echo "\n\n<pre>";
print_r($_POST);
echo "</pre>\n\n";
//die("\n\n<p>End debug</p>\n\n");


/**
 * Debug Code
 */
echo "\n\n<p>Begin debug</p>\n\n";
echo "\n\n<p>Var_dump \$: </p>\n\n";
echo "\n\n<pre>";
var_dump();
echo "</pre>\n\n";
echo "\n\n<p>Print_r \$: </p>\n\n";
echo "\n\n<pre>";
print_r();
echo "</pre>\n\n";
die("\n\n<p>End debug</p>\n\n");