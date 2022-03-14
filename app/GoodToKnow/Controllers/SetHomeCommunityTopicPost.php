<?php

namespace GoodToKnow\Controllers;

class SetHomeCommunityTopicPost
{
    public function page(int $community_id = 0, int $topic_id = 0, int $post_id = 0)
    {
        /**
         * This route sets up the session so that it is ready to load
         * a specific blog resource and then redirect to Home page.
         * The Home page presents the resource for viewing. Although
         * Home is being given all the data it needs we have a mechanism
         * which enables Home to refresh some of its data.
         *
         * This route will establish the type_of_resource_requested, and
         * it will gather data for the resource. It will establish
         * a time of refresh for (special) data so that the Home page will
         * not need to reload them when Home is loaded directly after this
         * route yet if the home page is loaded directly (like a page refresh)
         * then the special data will be loaded if it has expired.
         */
    }
}