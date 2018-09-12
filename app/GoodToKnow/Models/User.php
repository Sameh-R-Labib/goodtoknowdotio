<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/6/18
 * Time: 12:07 AM
 */

namespace GoodToKnow\Models;


class User extends GoodObject
{
    /**
     * @var string
     */
    protected static $table_name = "users";

    /**
     * @var array
     */
    protected static $fields = ['id', 'username', 'password', 'id_of_default_community', 'title', 'role',
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
     * @param \mysqli $db
     * @param string $error
     * @param string $username
     * @param string $password
     * @return bool|object|\stdClass
     */
    public static function authenticate(\mysqli $db, string &$error, string $username, string $password)
    {
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
            $stmt = $db->stmt_init();
            if (!$stmt->prepare($sql)) {
                $error .= $stmt->error . ' ';
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
            $error .= ' User::authenticate() caught a thrown exception: ' .
                htmlentities($e->getMessage(), ENT_QUOTES | ENT_HTML5) . ' ';
        }
        if (!empty($error)) {
            return false;
        }
        if (!password_verify($password, $user->password)) {
            $error .= " Authentication failed! ";
            return false;
        }

        return $user;
    }

    /**
     * @param \mysqli $db
     * @param string $error
     * @param string $username
     * @return bool
     */
    public static function is_taken_username(\mysqli $db, string &$error, string $username)
    {
        $sql = 'SELECT username FROM `users`
                WHERE `username` = "' . $db->real_escape_string($username) . '" LIMIT 1';

        $array_of_User_objects = parent::find_by_sql($db, $error, $sql);

        if (!$array_of_User_objects) {
            return false;
        }

        return true;
    }

    /**
     * @param \mysqli $db
     * @param string $error
     * @param string $username
     * @return bool|mixed
     */
    public static function find_by_username(\mysqli $db, string &$error, string $username)
    {
        /**
         * You give it a username and it returns the
         * corresponding User object or false.
         */
        $sql = 'SELECT username FROM `users`
                WHERE `username` = "' . $db->real_escape_string($username) . '" LIMIT 1';

        $array_of_User_objects = parent::find_by_sql($db, $error, $sql);

        if (!$array_of_User_objects || !empty($error)) {
            return false;
        }

        return array_shift($array_of_User_objects);
    }
}