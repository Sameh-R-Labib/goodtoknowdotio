<?php

namespace GoodToKnow\Models;

class changed_content extends good_object
{
    /**
     * @var string
     */
    protected static $table_name = "changed_content";

    /**
     * @var array
     */
    protected static $fields = ['id', 'time', 'name', 'type', 'post_id', 'expires', 'community_id', 'topic_id', 'author_username'];

    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $time;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var int
     */
    public $post_id;

    /**
     * @var int
     */
    public $expires;

    /**
     * @var int
     */
    public $community_id;

    /**
     * @var int
     */
    public $topic_id;

    /**
     * @var string
     */
    public $author_username;
}