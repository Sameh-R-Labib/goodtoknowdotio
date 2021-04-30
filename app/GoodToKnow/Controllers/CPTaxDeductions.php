<?php

namespace GoodToKnow\Controllers;

class CPTaxDeductions
{
    function page()
    {
        global $sessionMessage;
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;
        global $is_guest;
        global $page;
        global $show_poof;
        global $html_title;

        kick_out_loggedoutusers();

        $page = 'CPTaxDeductions';

        $show_poof = true;

        $html_title = 'TaxDeductions';

        $sessionMessage .= ' Managing tax deductions. ';

        require VIEWS . DIRSEP . 'cptaxdeductions.php';
    }
}