<?php

namespace GoodToKnow\Controllers;

class WhatIsThisSite
{
    function page()
    {
        /**
         * This function will present a page
         * which informs the people from the Internet who
         * land on the login page by chance and don't
         * have an idea what this site is for.
         */

        global $is_admin;
        global $is_guest;
        global $show_poof;
        global $special_community_array;
        global $type_of_resource_requested;

        $is_guest = true;

        $html_title = 'What is this site?';

        $page = 'About';

        $show_poof = true;

        $sessionMessage = " Read and decide if you'd like to use this. ";

        require VIEWS . DIRSEP . 'whatisthissite.php';
    }
}