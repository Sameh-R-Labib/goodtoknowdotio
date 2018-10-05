<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/4/18
 * Time: 10:35 PM
 */

namespace GoodToKnow\Controllers;


class CreateNewPostSave
{
    public function page()
    {
        global $sessionMessage;
        global $is_logged_in;
        global $user_id;
        global $saved_str01;                // The main title
        global $saved_str02;                // The title extension
        global $saved_int01;                // The topic id
        global $saved_int02;                // The sequence number

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Debug Code
         */
        echo "\n<p>Begin debug</p>\n";
        echo "<br><p>Var_dump \$user_id: </p>\n<pre>";
        var_dump($user_id);
        echo "</pre>\n";
        echo "<br><p>Var_dump \$saved_str01 (main title): </p>\n<pre>";
        var_dump($saved_str01);
        echo "</pre>\n";
        echo "<br><p>Var_dump \$saved_str02 (title extension): </p>\n<pre>";
        var_dump($saved_str02);
        echo "</pre>\n";
        echo "<br><p>Var_dump \$saved_int01 (topic id): </p>\n<pre>";
        var_dump($saved_int01);
        echo "</pre>\n";
        echo "<br><p>Var_dump \$saved_int02 (sequence number): </p>\n<pre>";
        var_dump($saved_int02);
        echo "</pre>\n";
    }
}