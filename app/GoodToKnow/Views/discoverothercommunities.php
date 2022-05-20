<?php

global $g;

/**
 * Debug Code
 */
echo "\n<p>Begin debug</p>\n";
echo "<p>Var_dump \$g->coms_user_does_not_belong_to: </p>\n<pre>";
var_dump($g->coms_user_does_not_belong_to);
echo "</pre>\n";
die("<p>End debug</p>\n");