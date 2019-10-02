<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Community;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class KommunityDescriptionEditorProcessor
{
    function page()
    {
        global $sessionMessage;

        kick_out_nonadmins();


        /**
         * Goal:
         *  1) Validate 'community'
         *  2) Save 'community' in the session.
         *  3) Redirect to a route.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $submitted_community_name = standard_form_field_prep('community', 1, 200);

        $db = get_db();

        $community = Community::find_by_community_name($db, $sessionMessage, $submitted_community_name);

        if (!$community) {

            breakout(' Unable to retrieve community object (possibly because the name you gave was invalid.) ');

        }

        $_SESSION['saved_int01'] = (int)$community->id;
        $_SESSION['saved_str01'] = $submitted_community_name;

        redirect_to("/ax1/KommunityDescriptionEditorForm/page");
    }
}