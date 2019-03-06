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

    function __construct(object $user)
    {
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
    }
}