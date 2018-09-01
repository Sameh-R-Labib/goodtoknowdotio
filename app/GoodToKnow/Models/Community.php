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
    protected static $table_name = "communities";

    protected static $fields = ['community_id', 'community_name', 'community_description'];

    public $community_id;

    public $community_name;

    public $community_description;
}