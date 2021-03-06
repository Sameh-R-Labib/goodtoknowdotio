<?php

namespace GoodToKnow\Models;

use stdClass;

class User extends GoodObject
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
         *   1) Determine whether or not the user is suspended per database
         *   2) If the user is suspended log him out and redirect to the page for logging in.
         *   3) Otherwise, return control over to where the function was called.
         */


        global $g;


        // Determine whether or not the user is suspended per database

        $user_object = User::find_by_id($g->user_id);

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


    /**
     * @param string $username
     * @param string $password
     * @return bool|object|stdClass
     */
    public static function authenticate(string $username, string $password)
    {
        global $g;

        /**
         * What you see here could have been done using the find_by_sql
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

                    $user = $result->fetch_object('\GoodToKnow\Models\User');

                    $stmt->close();

                }
            }
        } catch (\Exception $e) {

            $g->message .= ' User::authenticate() caught a thrown exception: ' .
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

        $array_of_User_objects = parent::find_by_sql($sql);

        if (!$array_of_User_objects) {

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
         * You give it a username and it returns the
         * corresponding User object or false.
         */

        global $g;

        $sql = 'SELECT * FROM `users`
                WHERE `username` = "' . $g->db->real_escape_string($username) . '" LIMIT 1';

        $array_of_User_objects = parent::find_by_sql($sql);

        if (!$array_of_User_objects || !empty($g->message)) {

            return false;

        }

        return array_shift($array_of_User_objects);
    }
}