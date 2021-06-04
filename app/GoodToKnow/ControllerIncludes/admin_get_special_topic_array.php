<?php

use GoodToKnow\Models\CommunityToTopic;


global $app_state;
global $db;


kick_out_nonadmins();


$db = get_db();

$app_state->special_topic_array = CommunityToTopic::get_topics_array_for_a_community($app_state->community_id);


if ($app_state->special_topic_array == false) $app_state->special_topic_array = [];


$_SESSION['special_topic_array'] = $app_state->special_topic_array;
$_SESSION['last_refresh_topics'] = time();
