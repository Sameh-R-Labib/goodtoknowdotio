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


        /**
         * Make sure this syntax is correct for my version of mysqldump command.
         *
         * Other possible syntax:
         *  * mysqldump --user=... --password=... --host=... DB_NAME > /path/to/output/file.sql
         *  * Usage: mysqldump [OPTIONS] database [tables]
         */


        /**
         * Will send strait to the browser.
         */

        $DBUSER = "user";
        $DBPASSWD = "password";
        $DATABASE = "user_db";

        $filename = "backup-" . date("d-m-Y") . ".sql.gz";
        $mime = "application/x-gzip";

        header("Content-Type: " . $mime);
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $cmd = "mysqldump -u $DBUSER --password=$DBPASSWD $DATABASE | gzip --best";

        passthru($cmd);

        exit(0);

    }
}