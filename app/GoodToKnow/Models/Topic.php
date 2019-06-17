<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/15/18
 * Time: 8:56 PM
 */

namespace GoodToKnow\Models;


class Topic extends GoodObject
{
    /**
     * @var string
     */
    protected static $table_name = "topics";

    /**
     * @var array
     */
    protected static $fields = ['id', 'sequence_number', 'topic_name', 'topic_description'];

    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $sequence_number;

    /**
     * @var string
     */
    public $topic_name;

    /**
     * @var string
     */
    public $topic_description;

    /**
     * @param string $message
     * @param string $description
     * @return bool
     */
    public static function is_topic_description(string &$message, string &$description)
    {
        /**
         * Trim it.
         * Can't be empty.
         * Must be less than 230 bytes long.
         * Can't contain any html tags
         */

        $description = trim($description);

        if (empty($description)) {
            $message .= " Your description is missing. ";
            return false;
        }

        $length = strlen($description);
        if ($length > 230) {
            $message .= " Your description is too long. ";
            return false;
        }

        if ($description != strip_tags($description)) {
            $message .= " Your description includes html. We don't allow that in this field. ";
            return false;
        }

        return true;
    }
}