<?php
/**
 * Debug Code
 */
echo "\n<p>Begin debug</p>\n";
echo "<br><p>Var_dump \$sessionMessage: </p>\n<pre>";
var_dump($sessionMessage);
echo "</pre>\n";
echo "<br><p>Var_dump \$array_of_post_objects: </p>\n<pre>";
var_dump($array_of_post_objects);
echo "</pre>\n";
echo "<br><p>Var_dump \$array_of_author_usernames: </p>\n<pre>";
var_dump($array_of_author_usernames);
echo "</pre>\n";
die("<br><p>End debug</p>\n");