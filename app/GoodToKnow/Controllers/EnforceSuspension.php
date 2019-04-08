<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-03-01
 * Time: 17:17
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\User;

class EnforceSuspension
{
    /**
     * @param \mysqli $db
     * @param string $error
     * @param int $user_id
     * @param int $when_last_checked_suspend
     * @return bool
     */
    public static function enforce_suspension(\mysqli $db, string &$error, int $user_id, int &$when_last_checked_suspend)
    {
        /**
         *   1) Determine whether or not the user is suspended per database
         *   2) If the user is suspended log him out and redirect to the page for logging in.
         *   3) Otherwise, return control over to where the function was called.
         */


        // Determine whether or not the user is suspended per database
        $user_object = User::find_by_id($db, $error, $user_id);
        if ($user_object === false) return false;

        // If the user is suspended log him out and redirect to the page for logging in.
        if ($user_object->is_suspended) {
            // The current script stops (we redirect to the Logout route.)
            redirect_to("/ax1/Logout/page");
        }

        // Otherwise, return control over to where the function was called.
        // At this point we've checked and we know the user is not suspended and the function did not bonk-out.
        return true;
    }
}