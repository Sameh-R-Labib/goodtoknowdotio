<?php

namespace GoodToKnow\Controllers;

class download_the_database
{
    function page()
    {
        /**
         * The purpose of this feature is to provide an SQL dump file of
         * Gtk.io's database to the browser for download.
         */


        kick_out_nonadmins();


        /**
         * Will send strait to the browser.
         */

        $db_user = DB_USER;
        $db_password = DB_PASS;
        $database = DB_NAME;

        $filename = "backup-" . date("d-m-Y_G_i_s") . ".sql.gz";

        header("Content-Type: application/x-gzip");
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $cmd = "mysqldump -u $db_user --password=$db_password $database | gzip --best";

        passthru($cmd);

        exit(0);

    }
}