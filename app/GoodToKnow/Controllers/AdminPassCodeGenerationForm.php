<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Community;

class AdminPassCodeGenerationForm
{
    function page()
    {
        global $db;
        global $sessionMessage;
        global $html_title;
        global $community_array;


        kick_out_nonadmins();


        /**
         * Here we need to have an enumerated array
         * of community objects. We will use this array
         * in the view template to generate each radio
         * input field. Each object has:
         *   - community_id
         *   - community_name
         *   - community_description
         */

        $db = get_db();


        // Community::find_all() should return the array we are looking for (see above)

        $community_array = Community::find_all($db, $sessionMessage);


        $html_title = 'Admin Pass-Code Generation Form';

        require VIEWS . DIRSEP . 'adminpasscodegenerationform.php';
    }
}