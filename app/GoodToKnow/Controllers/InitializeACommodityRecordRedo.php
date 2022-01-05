<?php

namespace GoodToKnow\Controllers;

class InitializeACommodityRecordRedo
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Tell the user he is seeing the form a 2nd time.
         */

        $g->message .= ' <b>We are giving you one chance to fix the time value which we think is wrong.</b> ';


        $g->html_title = 'One chance to redo';


        $g->action = '/ax1/InitializeACommodityRecordProcessor/page';
        $g->heading_one = 'Create a Commodity Record';
        require VIEWSDUPLICATESINCLUDES . DIRSEP . 'commodity_record_form.php';
    }
}