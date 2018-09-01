<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/31/18
 * Time: 9:29 PM
 */

namespace GoodToKnow\Models;


class Community extends GoodObject
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
}