<?php

namespace GoodToKnow\Controllers;

class DownloadTheDatabase
{
    function page()
    {
        /**
         * The purpose of this feature is to provide an SQL dump file of
         * Gtk.io's database to the browser for download.
         */


        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();
        
    }
}