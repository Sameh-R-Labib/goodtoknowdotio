<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\community;
use GoodToKnow\Models\user;
use GoodToKnow\Models\user_to_community;

class discover_other_communities
{
    function page()
    {
        /**
         * This feature (whose first route this is) lists
         * the communities (on the Gtk.io server) which the
         * user is not currently a member of. The purpose is
         * to enable the user to discover other communities.
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Q: What is the id of the user?
         * A: $g->user_id
         */

        /**
         * Get the system's communities (minus the user's.)
         */

        get_db();

        $user_object = user::find_by_id($g->user_id);

        if (!$user_object) {

            breakout(' Error 618113411: Unexpected unable to retrieve user. ');

        }

        // First get all the communities the user DOES belong to.

        $g->coms_user_belongs_to = user_to_community::coms_user_belongs_to($g->user_id);

        if ($g->coms_user_belongs_to === false) {

            breakout(' Error 38512481: Error encountered trying to retrieve communities for this user. ');

        }

        // Second get all the communities that exist in this system.
        // By "this system" I mean this instance of the app.

        $coms_in_this_system = community::find_all();

        if ($coms_in_this_system === false) {

            breakout(' Error 92737482: Unable to retrieve communities. ');

        }


        // Get communities user DOES NOT belong to.

        $g->coms_user_does_not_belong_to = user_to_community::coms_user_does_not_belong_to($coms_in_this_system);


        // Redirect if there are no communities which user doesn't belong to.

        if (empty($g->coms_user_does_not_belong_to)) {

            breakout(' You belong to all the communities. Therefore, there is no need to do anything. ');

        }


        /**
         * Show $g->coms_user_does_not_belong_to to the user.
         */

        $g->html_title = 'Discover Other Communities';

        require VIEWS . DIRSEP . 'discoverothercommunities.php';
    }
}