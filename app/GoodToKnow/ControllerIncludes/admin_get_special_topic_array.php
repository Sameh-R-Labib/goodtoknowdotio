<?php

use GoodToKnow\Models\CommunityToTopic;


global $gtk;
global $db;


kick_out_nonadmins();


$db = get_db();

$gtk->special_topic_array = CommunityToTopic::get_topics_array_for_a_community($gtk->community_id);


if ($gtk->special_topic_array == false) $gtk->special_topic_array = [];


$_SESSION['special_topic_array'] = $gtk->special_topic_array;
$_SESSION['last_refresh_topics'] = time();
