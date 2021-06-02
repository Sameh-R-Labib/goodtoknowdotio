<?php

global $special_topic_array;
global $app_state;
global $community_id;

kick_out_loggedoutusers();

require CONTROLLERINCLUDES . DIRSEP . 'get_topics_for_a_comm_inside_part.php';