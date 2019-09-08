<?php

namespace GoodToKnow\Controllers;

class SeeOneYearsPossibleTaxDeductionsYearFilter
{
    function page()
    {
        /**
         * 1) Validate the submitted year_paid.
         * 2) Present the PossibleTaxDeduction(s/plural) in a page whose layout is similar to the Home page.
         */

        global $is_admin;
        global $special_community_array;
        global $type_of_resource_requested;

        $array = [];    // Just to satisfy PhpStorm.

        global $sessionMessage;  // Just to satisfy PhpStorm.

        require CONTROLLERINCLUDES . DIRSEP . 'get_year_paid_and_its_possibletaxdeductions.php';

        /**
         * Loop through the array and replace attributes with more readable ones.
         */

        foreach ($array as $item) {
            $item->comment = nl2br($item->comment, false);
        }

        $sessionMessage .= ' Enjoy ʘ‿ʘ at One Year of your 🤔 Tax ✍🏽🔽s. ';

        $html_title = 'Enjoy ʘ‿ʘ at One Year of your 🤔 Tax ✍🏽🔽s.';

        $page = 'SeeOneYearsPossibleTaxDeductions';

        $show_poof = true;

        require VIEWS . DIRSEP . 'seeoneyearspossibletaxdeductionsyearfilter.php';
    }
}