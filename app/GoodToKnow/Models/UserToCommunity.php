<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/6/18
 * Time: 6:25 PM
 */

namespace GoodToKnow\Models;


class UserToCommunity extends GoodObject
{
    /**
     * @var string
     */
    protected static $table_name = "user_to_community";

    /**
     * @var array
     */
    protected static $fields = ['id', 'user_id', 'community_id'];

    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $user_id;

    /**
     * @var int
     */
    public $community_id;

    /**
     * @param \mysqli $db
     * @param string $error
     * @param int $user_id
     * @return array|bool
     */
    public static function coms_user_belongs_to(\mysqli $db, string &$error, int $user_id)
    {
        /**
         * Returns array of community objects or returns false.
         */

        /**
         * First get the UserToCommunity objects which belong to the user.
         */
        $sql = 'SELECT * FROM user_to_community WHERE `user_id`=' . $user_id;
        $user_to_community_array = self::find_by_sql($db, $sessionMessage, $sql);

        if (!$user_to_community_array) {
            $error .= " UserToCommunity::coms_user_belongs_to() found no communities for the specified user. ";
            return false;
        }

        /**
         * Second get the Community objects which belong to the user.
         */
        $array_of_coms_for_this_user = [];
        foreach ($user_to_community_array as $user_to_community_object) {
            // Add a community object to $array_of_coms_for_this_user.
            // Obviously this community which we will add will be the one specified by the UserToCommunity object.
            $community = Community::find_by_id($db, $error, $user_to_community_object->community_id);
            if ($community === false) {
                return false;
            } else {
                $array_of_coms_for_this_user[] = $community;
            }
        }
        if (empty($array_of_coms_for_this_user)) {
            $error .= " UserToCommunity::coms_user_belongs_to() says: Unexpected empty array_of_coms_for_this_user. ";
            return false;
        } else {
            return $array_of_coms_for_this_user;
        }
    }
}