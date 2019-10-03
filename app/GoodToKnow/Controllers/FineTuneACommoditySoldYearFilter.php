<?php

namespace GoodToKnow\Controllers;

class FineTuneACommoditySoldYearFilter
{
    function page()
    {
        require CONTROLLERINCLUDES . DIRSEP . 'get_tax_year_and_its_commodities_sold.php';

        $html_title = 'Which Commodity Sold?';

        require VIEWS . DIRSEP . 'finetuneacommoditysoldyearfilter.php';
    }
}