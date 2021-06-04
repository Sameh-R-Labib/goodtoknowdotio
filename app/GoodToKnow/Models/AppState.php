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
     * @var int|mixed
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
     * @var string
     */
    public $timezone;


    /**
     * @var int|mixed
     */
    public $community_id;


    /**
     * @var string
     */
    public $community_name;


    /**
     * @var string
     */
    public $community_description;


    /**
     * @var array
     */
    public $special_community_array;


    /**
     * @var int|mixed
     */
    public $topic_id;


    /**
     * @var string
     */
    public $topic_name;


    /**
     * @var string
     */
    public $topic_description;


    /**
     * @var int|mixed
     */
    public $post_id;


    /**
     * @var string
     */
    public $post_name;


    /**
     * @var string
     */
    public $post_full_name;


    /**
     * @var string
     */
    public $type_of_resource_requested;


    /**
     * @var array
     */
    public $special_topic_array;


    /**
     * @var array
     */
    public $special_post_array;


    /**
     * @var int
     */
    public $last_refresh_communities;


    /**
     * @var int
     */
    public $last_refresh_topics;


    /**
     * @var int
     */
    public $last_refresh_posts;


    /**
     * @var int
     */
    public $last_refresh_content;


    /**
     * @var string
     */
    public $post_content;


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

        $this->timezone = (isset($_SESSION['timezone'])) ? $_SESSION['timezone'] : 'America/New_York';

        $this->community_id = (isset($_SESSION['community_id'])) ? $_SESSION['community_id'] : 0;

        $this->community_name = (isset($_SESSION['community_name'])) ? $_SESSION['community_name'] : '';

        $this->community_description = (isset($_SESSION['community_description'])) ? $_SESSION['community_description'] : '';

        $this->special_community_array = (isset($_SESSION['special_community_array'])) ? $_SESSION['special_community_array'] : [];

        $this->topic_id = (isset($_SESSION['topic_id'])) ? $_SESSION['topic_id'] : 0;

        $this->topic_name = (isset($_SESSION['topic_name'])) ? $_SESSION['topic_name'] : '';

        $this->topic_description = (isset($_SESSION['topic_description'])) ? $_SESSION['topic_description'] : '';

        $this->post_id = (isset($_SESSION['post_id'])) ? $_SESSION['post_id'] : 0;

        $this->post_name = (isset($_SESSION['post_name'])) ? $_SESSION['post_name'] : '';

        $this->post_full_name = (isset($_SESSION['post_full_name'])) ? $_SESSION['post_full_name'] : '';

        $this->type_of_resource_requested = (isset($_SESSION['type_of_resource_requested'])) ? $_SESSION['type_of_resource_requested'] : '';

        $this->special_topic_array = (isset($_SESSION['special_topic_array'])) ? $_SESSION['special_topic_array'] : [];

        $this->special_post_array = (isset($_SESSION['special_post_array'])) ? $_SESSION['special_post_array'] : [];

        $this->last_refresh_communities = (isset($_SESSION['last_refresh_communities'])) ? $_SESSION['last_refresh_communities'] : 1554825315;

        $this->last_refresh_topics = (isset($_SESSION['last_refresh_topics'])) ? $_SESSION['last_refresh_topics'] : 1554825315;

        $this->last_refresh_posts = (isset($_SESSION['last_refresh_posts'])) ? $_SESSION['last_refresh_posts'] : 1554825315;

        $this->last_refresh_content = (isset($_SESSION['last_refresh_content'])) ? $_SESSION['last_refresh_content'] : 1554825315;

        $this->post_content = (isset($_SESSION['post_content'])) ? $_SESSION['post_content'] : '';
    }
}