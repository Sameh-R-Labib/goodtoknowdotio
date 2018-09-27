<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/27/18
 * Time: 1:55 PM
 */

namespace GoodToKnow\Controllers;


class DefaultCommunityProcessor
{
    public function page()
    {
        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in OR $is_admin) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }


        /**
         * Debug Code
         */
        echo "\n<p>Begin debug</p>\n";
        echo "<br><p>Var_dump \$_POST['choice']: </p>\n<pre>";
        var_dump($_POST['choice']);
        echo "</pre>\n";
        echo "<br><p>Print_r \$_POST: </p>\n<pre>";
        print_r($_POST);
        echo "</pre>\n";
        die("<br><p>End debug</p>\n");


        if (empty($_POST['choice'])) {
            $_SESSION['message'] .= " Aborted! Expected submission of choice not found. ";
            redirect_to("/ax1/Home/page");
        }
    }
}