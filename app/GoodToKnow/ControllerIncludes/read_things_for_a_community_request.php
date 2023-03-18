<?php

/**
 * This is to be used in routes:
 * - home
 * - set_home_community_topic_post
 *
 * This is to be used when:
 * - $g->type_of_resource_requested == 'community';
 *
 * This is to be used for:
 * - Reading the data which is related to a request for a home page which shows a community.
 * - Making the data available for the home view.
 * - Saving the data in the session file.
 */

global $g;