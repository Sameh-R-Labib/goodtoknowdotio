<?php

namespace GoodToKnow\Models;

use Exception;
use stdClass;

class user extends good_object
{
    /**
     * @var string
     */
    protected static $table_name = "users";

    /**
     * @var array
     */
    protected static $fields = ['id', 'username', 'password', 'id_of_default_community', 'timezone', 'title', 'role',
        'race', 'is_suspended', 'date', 'comment'];

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @var int
     */
    public $id_of_default_community;

    /**
     * @var string
     */
    public $timezone;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $role;

    /**
     * @var string
     */
    public $race;

    /**
     * @var int
     */
    public $is_suspended;

    /**
     * @var string
     */
    public $date;

    /**
     * @var string
     */
    public $comment;


    /**
     * @return bool
     */
    public static function enforce_suspension(): bool
    {
        /**
         *   1) Determine whether the user is suspended per database
         *   2) If the user is suspended log him out and redirect to the page for logging in.
         *   3) Otherwise, return control over to where the function was called.
         */


        global $g;


        // Determine whether the user is suspended per database

        $user_object = user::find_by_id($g->user_id);

        if ($user_object === false) return false;


        // If the user is suspended log him out and redirect to the page for logging in.

        if ($user_object->is_suspended) {

            // The current script stops (we redirect to the logout route.)

            $g->is_logged_in = false;
            $_SESSION['is_logged_in'] = $g->is_logged_in;
            $g->message .= " Error H64B51. ";
            redirect_to("/ax1/login_form/page");
        }

        // Otherwise, return control over to where the function was called.
        // At this point we've checked, and we know the user is not suspended and the function did not bonk-out.

        return true;
    }


    /**
     * @param string $username
     * @param string $password
     * @return false|mixed|object|stdClass|null
     */
    public static function authenticate(string $username, string $password)
    {
        global $g;

        /**
         * What you see here could have been done using the find_by_sql,
         * but I chose to do this explicitly using a prepared statement since
         * that helps rebuff sql injection attacks.
         */

        try {
            $sql = 'SELECT *
                    FROM `users`
                    WHERE `username` = ?
                    LIMIT 1';

            $stmt = $g->db->stmt_init();

            if (!$stmt->prepare($sql)) {

                $g->message .= $stmt->error . ' ';

                return false;

            } else {
                $stmt->bind_param('s', $username);

                $stmt->execute();

                $result = $stmt->get_result();

                $numrows = $result->num_rows;

                if (!$numrows) {

                    $stmt->close();

                    return false;

                } else {

                    $user = $result->fetch_object('\GoodToKnow\Models\user');

                    $stmt->close();

                }
            }
        } catch (Exception $e) {

            $g->message .= ' user::authenticate() caught a thrown exception: ' .
                htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';

            return false;

        }

        if (!password_verify($password, $user->password)) {

            $g->message .= " Authentication failed! ";

            return false;
        }

        return $user;
    }


    /**
     * @param string $username
     * @return bool
     */
    public static function is_taken_username(string $username): bool
    {
        global $g;

        $sql = 'SELECT username FROM `users`
                WHERE `username` = "' . $g->db->real_escape_string($username) . '" LIMIT 1';

        $array_of_user_objects = parent::find_by_sql($sql);

        if (!$array_of_user_objects) {

            return false;

        }

        return true;
    }


    /**
     * @param string $username
     * @return bool|mixed
     */
    public static function find_by_username(string $username)
    {
        /**
         * You give it a username, and it returns the
         * corresponding user object or false.
         */

        global $g;

        $sql = 'SELECT * FROM `users`
                WHERE `username` = "' . $g->db->real_escape_string($username) . '" LIMIT 1';

        $array_of_user_objects = parent::find_by_sql($sql);

        if (!$array_of_user_objects) {

            return false;

        }

        return array_shift($array_of_user_objects);
    }
}