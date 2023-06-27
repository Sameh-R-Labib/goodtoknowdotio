<?php

namespace GoodToKnow\Controllers;

class new_community
{
    function page()
    {
        /**
         * This route will generate a form where Admin can enter the information needed to generate a new community.
         *
         * What are the db fields for a community?
         *  - id int(10)
         *  - community_name varchar(200)
         *  - community_description varchar(230)
         */


        global $g;


        kick_out_nonadmins();


        $g->html_title = 'Create a New Community';


        require VIEWS . DIRSEP . 'newcommunity.php';
    }
}