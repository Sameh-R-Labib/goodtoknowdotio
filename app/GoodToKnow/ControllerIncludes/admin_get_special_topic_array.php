<?php

use GoodToKnow\Models\CommunityToTopic;


global $g;
global $db;


kick_out_nonadmins();


$db = get_db();

$g->special_topic_array = CommunityToTopic::get_topics_array_for_a_community($g->community_id);


if ($g->special_topic_array == false) $g->special_topic_array = [];


$_SESSION['special_topic_array'] = $g->special_topic_array;
$_SESSION['last_refresh_topics'] = time();
