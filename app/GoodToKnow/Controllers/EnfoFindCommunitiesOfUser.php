<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-04-02
 * Time: 21:15
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Community;
use GoodToKnow\Models\UserToCommunity;


class EnfoFindCommunitiesOfUser
{
    /**
     * @param \mysqli $db
     * @param string $error
     * @param $user_id
     * @return array|bool
     */
    public static function find_communities_of_user(\mysqli $db, string &$error, $user_id)
    {
        /**
         * The goal of this function is to return a special_community_array.
         * For our purposes here a special_community_array is an associative
         * array which associates each community ID with its community name.
         * This is an array ONLY for the communities this user belongs to.
         */

        /**
         * So, the first get all the communities
         * for the user.
         */
        $sql = 'SELECT * FROM user_to_community WHERE `user_id`=' . $user_id;
        $user_to_community_array = UserToCommunity::find_by_sql($db, $error, $sql);

        if (!$user_to_community_array) {
            $error .= " EnfoFindCommunitiesOfUser::find_communities_of_user says unexpected no user_to_community_array. ";
            return false;
        }

        /**
         * Build the array I'm looking for.
         */
        $special_community_array = [];
        foreach ($user_to_community_array as $value) {
            // Talking about the right side of the assignment statement
            // First we're getting a Community object
            $special_community_array[$value->community_id] = Community::find_by_id($db, $error, $value->community_id);
            if (!$special_community_array[$value->community_id]) {
                $error .= " EnfoFindCommunitiesOfUser::find_communities_of_user says err_no 20848. ";
                return false;
            }
            // Then we're getting the community_name from that object
            $special_community_array[$value->community_id] = $special_community_array[$value->community_id]->community_name;
        }

        return $special_community_array;
    }
}