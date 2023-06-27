<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\community;

class admin_pass_code_generation_form
{
    function page()
    {
        global $g;


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

        get_db();


        // community::find_all() should return the array we are looking for (see above)

        $g->community_array = community::find_all();


        $g->html_title = 'Admin Pass-Code Generation Form';

        require VIEWS . DIRSEP . 'adminpasscodegenerationform.php';
    }
}