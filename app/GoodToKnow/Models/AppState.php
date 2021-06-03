<?php


namespace GoodToKnow\Models;


class AppState
{
    /**
     * @var string
     */
    public $message;


    /**
     * @var string
     */
    public $url_of_most_recent_upload;

    /**
     * @var int
     */
    public $user_id;


    /**
     * @var string
     */
    public $user_username;


    /**
     * @var string
     */
    public $role;


    /**
     * AppState constructor.
     */
    function __construct()
    {
        $this->message = (isset($_SESSION['message'])) ? $_SESSION['message'] : '';

        $_SESSION['message'] = '';

        $this->url_of_most_recent_upload = (isset($_SESSION['url_of_most_recent_upload'])) ? $_SESSION['url_of_most_recent_upload'] : '';

        $this->user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 0;

        $this->user_username = (isset($_SESSION['user_username'])) ? $_SESSION['user_username'] : '';

        $this->role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '';
    }
}