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
         * Returns array of communities if no unexpected error occurs.
         * Returns false if an error occurs.
         * Note: this "array of communities" may be empty.
         */

        // This is what we hope to return
        $array_of_coms_for_this_user = [];

        /**
         * First get the UserToCommunity objects which belong to the user.
         */
        $sql = 'SELECT * FROM user_to_community WHERE `user_id`=' . $user_id;
        $user_to_community_array = self::find_by_sql($db, $error, $sql);

        if (!$user_to_community_array) {
            $error .= " UserToCommunity::coms_user_belongs_to() found no communities for the specified user. ";
            return $array_of_coms_for_this_user;
        }

        /**
         * Second get the Community objects which belong to the user.
         */
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

    /**
     * @param array $coms_in_this_system
     * @param array $coms_user_belongs_to
     * @return array
     */
    public static function coms_user_does_not_belong_to(array $coms_in_this_system, array $coms_user_belongs_to)
    {
        /**
         * Returns an array of Community objects which the user doesn't belong to.
         */
        $coms_user_does_not_belong_to = [];
        foreach ($coms_in_this_system as $community) {
            if (self::community_is_one_which_user_already_belongs_to($community, $coms_user_belongs_to)) {
                continue;
            }
            $coms_user_does_not_belong_to[] = $community;
        }
        return $coms_user_belongs_to;
    }

    /**
     * @param object $community
     * @param array $coms_user_belongs_to
     * @return bool
     */
    public static function community_is_one_which_user_already_belongs_to(object $community, array $coms_user_belongs_to)
    {
        foreach ($coms_user_belongs_to as $object) {
            if ($community->id == $object->id) {
                return true;
            }
        }
        return false;
    }
}