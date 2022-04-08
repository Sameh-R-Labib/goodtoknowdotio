<?php

global $g;


/**
 * Refresh special_topic_array
 */

require CONTROLLERINCLUDES . DIRSEP . 'get_special_topic_array.php';


// Abort if the community doesn't have any topics yet

if (empty($g->special_topic_array)) {

    breakout(' Aborted because this community has no topics. ');

}

$g->html_title = 'Which topic?';