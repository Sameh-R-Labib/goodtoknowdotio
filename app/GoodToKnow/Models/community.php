<?php

namespace GoodToKnow\Models;


class community extends good_object
{
    /**
     * @var string
     */
    protected static $table_name = "communities";

    /**
     * @var array
     */
    protected static $fields = ['id', 'community_name', 'community_description'];

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $community_name;

    /**
     * @var string
     */
    public $community_description;


    /**
     * @param string $community_name
     * @return bool|mixed
     */
    public static function find_by_community_name(string $community_name)
    {
        /**
         * You give it a username, and it returns the
         * corresponding user object or false.
         */

        global $g;

        $sql = 'SELECT * FROM `communities`
                WHERE `community_name` = "' . $g->db->real_escape_string($community_name) . '" LIMIT 1';

        $array_of_community_objects = parent::find_by_sql($sql);

        $temp_error = trim($g->message);

        if (!$array_of_community_objects || !empty($temp_error)) {

            return false;

        }

        return array_shift($array_of_community_objects);
    }
}