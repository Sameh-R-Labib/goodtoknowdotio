<?php

namespace GoodToKnow\Controllers;

class pick_off_some
{
    function page()
    {
        /**
         * As with "Cull The Herd" feature, the goal is to reduce the amount of
         * changed_content table rows in the database. In the "Pick Off Some" feature
         * we show the administrator some checkboxes next to the names associated with rows
         * of changed_content table. Thus enabling the deletion of one or more rows.
         */


        kick_out_nonadmins_or_if_there_is_error_msg();


        get_db();
    }
}