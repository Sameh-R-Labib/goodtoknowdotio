<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-03-06
 * Time: 14:04
 */

namespace GoodToKnow\Models;


class ReadableUser
{
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
    public $readable_community_name;

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
    public $readable_role;

    /**
     * @var string
     */
    public $race;

    /**
     * @var string
     */
    public $readable_race;

    /**
     * @var int
     */
    public $is_suspended;

    /**
     * @var string
     */
    public $readable_is_suspended;

    /**
     * @var string
     */
    public $date;

    /**
     * @var string
     */
    public $comment;

    function __construct(object $user, array $community_values_array)
    {
        /**
         * The purpose of having $community_values_array is so we don't have to keep extracting its data from the database.
         * $community_values_array has elements described as follows:
         * The key is a community id and the value is the community name which corresponds to that community id.
         */
        $this->id = $user->id;
        $this->username = $user->username;
        $this->password = '';
        $this->id_of_default_community = $user->id_of_default_community;
        $this->title = $user->title;
        $this->role = $user->role;
        $this->race = $user->race;
        $this->is_suspended = $user->is_suspended;
        $this->date = $user->date;
        $this->comment = $user->comment;

        $this->assign_readable_community_name($community_values_array);
        $this->assign_readable_role();
        $this->assign_readable_race();
        $this->assign_readable_is_suspended();
    }

    private function assign_readable_is_suspended()
    {
        /**
         * Assign a value to $this->readable_is_suspended:
         * Replace a 0 with No and a positive or negative integer with a Yes in the is_suspended.
         */
        if ($this->is_suspended === 0) {
            $this->readable_is_suspended = "No";
        } else {
            $this->readable_is_suspended = "Yes";
        }
    }

    private function assign_readable_race()
    {
        /**
         * Assign a value to $this->readable_race:
         * Replace the hyphens and underscores with a space and capitalize the first letter of each word.
         */
        $characters_to_replace_array = ['-', '_'];
        $this->readable_race = str_replace($characters_to_replace_array, " ", $this->race);
        $this->readable_race = ucfirst($this->readable_race);
    }

    private function assign_readable_community_name(array $community_values_array)
    {
        /**
         * This function will assign a community name to $readable_community_name
         */
        $this->readable_community_name = $community_values_array[$this->id_of_default_community];
    }

    private function assign_readable_role()
    {
        /**
         * Assign a value to $this->readable_role:
         * Replace the hyphens and underscores in the role with a space and capitalize the first letter of each word.
         */
        $characters_to_replace_array = ['-', '_'];
        $this->readable_role = str_replace($characters_to_replace_array, " ", $this->role);
        $this->readable_role = ucfirst($this->readable_role);
    }
}