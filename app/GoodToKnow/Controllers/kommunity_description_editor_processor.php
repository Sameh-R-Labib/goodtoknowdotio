<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\community;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class kommunity_description_editor_processor
{
    function page()
    {
        global $g;


        kick_out_nonadmins();


        /**
         * Goal:
         *  1) Validate 'community'
         *  2) Save 'community' in the session.
         *  3) Redirect to a route.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $submitted_community_name = standard_form_field_prep('community', 1, 200);

        get_db();

        $community = community::find_by_community_name($submitted_community_name);

        if (!$community) {

            breakout(' Unable to retrieve community object (possibly because the name you gave was invalid.) ');

        }

        $_SESSION['saved_int01'] = (int)$community->id;
        $_SESSION['saved_str01'] = $submitted_community_name;

        redirect_to("/ax1/kommunity_description_editor_form/page");
    }
}