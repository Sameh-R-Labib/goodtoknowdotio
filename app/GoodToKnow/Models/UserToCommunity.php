<?php

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
     * @param int $user_id
     * @return array|bool
     */
    public static function coms_user_belongs_to(int $user_id)
    {
        /**
         * Returns array of communities if no unexpected error occurs.
         * Returns false if an error occurs.
         * Note: this "array of communities" may be empty.
         */


        global $app_state;


        // This is what we hope to return

        $array_of_coms_for_this_user = [];


        /**
         * First get the UserToCommunity objects which belong to the user.
         */

        $sql = 'SELECT * FROM user_to_community WHERE `user_id`=' . $user_id;

        $user_to_community_array = self::find_by_sql($sql);

        if (!$user_to_community_array) {

            $app_state->message .= " UserToCommunity::coms_user_belongs_to() found no communities for the specified user. ";

            return $array_of_coms_for_this_user;

        }


        /**
         * Second get the Community objects which belong to the user.
         */

        foreach ($user_to_community_array as $user_to_community_object) {
            // Add a community object to $array_of_coms_for_this_user.
            // Obviously this community which we will add will be the one specified by the UserToCommunity object.

            $community = Community::find_by_id($user_to_community_object->community_id);

            if ($community === false) {

                return false;

            } else {

                $array_of_coms_for_this_user[] = $community;

            }
        }

        if (empty($array_of_coms_for_this_user)) {

            $app_state->message .= " UserToCommunity::coms_user_belongs_to() says: Unexpected empty array_of_coms_for_this_user. ";

            return false;

        } else {

            return $array_of_coms_for_this_user;

        }
    }


    /**
     * @param array $coms_in_this_system
     * @return array
     */
    public static function coms_user_does_not_belong_to(array $coms_in_this_system): array
    {
        /**
         * Returns an array of Community objects which the user doesn't belong to.
         */

        $coms_user_does_not_belong_to = [];

        foreach ($coms_in_this_system as $community) {

            if (self::community_is_one_which_user_already_belongs_to($community)) {

                continue;

            }

            $coms_user_does_not_belong_to[] = $community;

        }

        return $coms_user_does_not_belong_to;
    }


    /**
     * @param object $community
     * @return bool
     */
    public static function community_is_one_which_user_already_belongs_to(object $community): bool
    {
        global $coms_user_belongs_to;

        foreach ($coms_user_belongs_to as $object) {

            if ($community->id == $object->id) {

                return true;

            }

        }

        return false;
    }


    /**
     * @param $user_id
     * @return array|bool
     */
    public static function find_communities_of_user($user_id)
    {
        /**
         * The goal of this function is to return a special_community_array.
         * For our purposes here a special_community_array is an associative
         * array which associates each community ID with its community name.
         * This is restricted to ONLY the communities this user belongs to.
         */


        global $app_state;


        /**
         * Get all the communities for the user.
         */

        $sql = 'SELECT * FROM user_to_community WHERE `user_id`=' . $user_id;

        $array_of_user_to_community_objects = UserToCommunity::find_by_sql($sql);

        if (!$array_of_user_to_community_objects) {

            $app_state->message .= " find_communities_of_user() says unexpectedly received No user_to_community_array. ";

            return false;

        }


        /**
         * Build the array I'm looking for.
         */

        $special_community_array = [];

        foreach ($array_of_user_to_community_objects as $object) {

            /**
             * Talking about the right side of the assignment statement First we're getting a Community object.
             */

            $special_community_array[$object->community_id] = Community::find_by_id($object->community_id);

            if (!$special_community_array[$object->community_id]) {

                $app_state->message .= " find_communities_of_user() says err_no 20848. ";

                return false;

            }

            /**
             * Then we're getting the community_name from that object.
             */

            $special_community_array[$object->community_id] = $special_community_array[$object->community_id]->community_name;
        }

        return $special_community_array;
    }
}