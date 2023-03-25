<?php

use GoodToKnow\Models\community_to_topic;


global $g;


$g->special_topic_array = community_to_topic::get_topics_array_for_a_community($g->community_id);


if (!$g->special_topic_array) $g->special_topic_array = [];


$_SESSION['special_topic_array'] = $g->special_topic_array;
$_SESSION['last_refresh_topics'] = time();
