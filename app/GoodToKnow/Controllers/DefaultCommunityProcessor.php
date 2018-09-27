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
        global $special_community_array;

        if (!$is_logged_in OR $is_admin) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (empty($_POST['choice'])) {
            $_SESSION['message'] .= " Expected submission of choice not found. ";
            redirect_to("/ax1/Home/page");
        }

        /**
         * Make sure the submitted choice is valid for this user.
         */
        $is_found = false;
        if (array_key_exists($_POST['choice'], $special_community_array)) $is_found = true;
        if (!$is_found) {
            $_SESSION['message'] .= " Choice is not valid. ";
            redirect_to("/ax1/Home/page");
        }

        /**
         * Debug Code
         */
        echo "\n<p>Begin debug</p>\n";
        echo "<br><p>Var_dump \$is_found: </p>\n<pre>";
        var_dump($is_found);
        echo "</pre>\n";
        echo "<br><p>Print_r \$_POST['choice']: </p>\n<pre>";
        print_r($_POST['choice']);
        echo "</pre>\n";
        echo "<br><p>Print_r \$special_community_array: </p>\n<pre>";
        print_r($special_community_array);
        echo "</pre>\n";
        die("<br><p>End debug</p>\n");
    }
}