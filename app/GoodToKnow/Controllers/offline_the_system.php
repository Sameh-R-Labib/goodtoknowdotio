<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\status;

class offline_the_system
{
    function page()
    {
        /**
         * FEATURE OVERVIEW
         * ================
         *
         * Feature Name: "Offline The System"
         *
         * This feature enables Admin to toggle a running Gtk.io system
         * between "normal" and "offline" state.
         *
         * The offline state kicks out all non-Admin users to the login page.
         * This gives Admin the opportunity to do maintenance on the system
         * without bothering with user activity which may cause anomalies.
         */

        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        get_db();


        /**
         * Firstly, we need to get the current status object.
         */

        $status_object = status::find_by_id(1);

        /**
         * Debug Code
         */
        echo "\n<p>Begin debug</p>\n";
        echo "<p>Var_dump \$status_object: </p>\n<pre>";
        var_dump($status_object);
        echo "</pre>\n";
        die("<p>End debug</p>\n");
    }
}