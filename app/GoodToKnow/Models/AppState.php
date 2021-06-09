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
     * @var string
     */
    public $author_username;


    /**
     * @var int|mixed
     */
    public $author_id;


    /**
     * @var int
     */
    public $when_last_checked_suspend;


    /**
     * @var int|null
     */
    public $messages_last_quantity;


    /**
     * @var int|null
     */
    public $messages_last_time;


    /**
     * @var string
     */
    public $saved_str01;


    /**
     * @var string
     */
    public $saved_str02;


    /**
     * @var int
     */
    public $saved_int01;


    /**
     * @var int
     */
    public $saved_int02;


    /**
     * @var array
     */
    public $saved_arr01;


    /**
     * @var bool
     */
    public $is_logged_in;


    /**
     * @var bool
     */
    public $is_admin;


    /**
     * @var bool
     */
    public $is_guest;


    /**
     * @var string
     */
    public $page;


    /**
     * @var string
     */
    public $html_title;


    /**
     * @var string
     */
    public $long_title_of_post;


    /**
     * @var string
     */
    public $pre_populate;


    /**
     * @var array
     */
    public $array;


    /**
     * @var string
     */
    public $markdown;


    /**
     * @var array
     */
    public $coms_user_belongs_to;


    /**
     * @var array
     */
    public $coms_user_does_not_belong_to;


    /**
     * @var bool
     */
    public $show_poof;


    /**
     * @var array|int
     */
    public $time_bought;


    /**
     * @var array|int
     */
    public $time_sold;


    /**
     * @var array|int
     */
    public $time;


    /**
     * @var array|int
     */
    public $last;


    /**
     * @var array|int
     */
    public $next;


    /**
     * @var null|object
     */
    public $object;


    /**
     * @var null|object
     */
    public $community_object;


    /**
     * @var null|object
     */
    public $message_object;


    /**
     * @var null|object
     */
    public $topic_object;


    /**
     * @var null|object
     */
    public $bitcoin_object;


    /**
     * @var null|object
     */
    public $user_object;


    /**
     * @var null|object
     */
    public $recurring_payment_object;


    /**
     * @var string
     */
    public $thing_type;


    /**
     * @var string
     */
    public $thing_name;


    /**
     * @var string|mixed
     */
    public $result;


    /**
     * @var string
     */
    public $fields;


    /**
     * @var string
     */
    public $present;


    /**
     * @var array
     */
    public $array_of_post_objects;


    /**
     * @var array
     */
    public $array_of_author_usernames;


    /**
     * @var array
     */
    public $array_of_recurring_payment_objects;


    /**
     * @var array
     */
    public $array_of_bitcoin_objects;


    /**
     * @var array
     */
    public $array_of_objects;


    /**
     * @var array
     */
    public $inbox_messages_array;


    /**
     * @var array
     */
    public $readable_user_objects_array;


    /**
     * @var array
     */
    public $submitted_community_ids_array;


    /**
     * @var array
     */
    public $community_array;


    /**
     * @var string
     */
    public $account;


    /**
     * @var string
     */
    public $account_type;


    /**
     * @var string
     */
    public $bank;


    /**
     * @var int
     */
    public $chosen_topic_id;


    /**
     * @var int
     */
    public $price_bought;


    /**
     * @var int
     */
    public $price_sold;


    /**
     * @var string
     */
    public $currency_transacted;


    /**
     * @var int
     */
    public $commodity_amount;


    /**
     * AppState constructor.
     */
    function __construct()
    {
        /**
         * Extractors from $_SESSION
         */

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

        $this->author_username = (isset($_SESSION['author_username'])) ? $_SESSION['author_username'] : '';

        $this->author_id = (isset($_SESSION['author_id'])) ? $_SESSION['author_id'] : 0;

        $this->when_last_checked_suspend = (isset($_SESSION['when_last_checked_suspend'])) ? $_SESSION['when_last_checked_suspend'] : 1554825315;

        $this->messages_last_quantity = (isset($_SESSION['messages_last_quantity'])) ? $_SESSION['messages_last_quantity'] : null;

        $this->messages_last_time = (isset($_SESSION['messages_last_time'])) ? $_SESSION['messages_last_time'] : null;

        $this->saved_str01 = (isset($_SESSION['saved_str01'])) ? $_SESSION['saved_str01'] : '';

        $this->saved_str02 = (isset($_SESSION['saved_str02'])) ? $_SESSION['saved_str02'] : '';

        $this->saved_int01 = (isset($_SESSION['saved_int01'])) ? $_SESSION['saved_int01'] : 0;

        $this->saved_int02 = (isset($_SESSION['saved_int02'])) ? $_SESSION['saved_int02'] : 0;

        $this->saved_arr01 = (isset($_SESSION['saved_arr01'])) ? $_SESSION['saved_arr01'] : [];


        /**
         * Simplifies
         */

        $this->is_logged_in = !empty($this->user_id);

        $this->is_admin = $this->role === 'admin';

        // When set to true it tells some Gtk.io views to show version of parts of the page which
        // non-authenticated users should see and hide the parts which they should not see.
        $this->is_guest = false;


        /**
         * Globalizes
         */

        $this->page = 'Home';

        $this->html_title = '';

        $this->long_title_of_post = '';

        $this->pre_populate = '';

        $this->array = [];

        $this->markdown = '';

        // coms_user_belongs_to is a temporary var used for managing any user's communities.
        $this->coms_user_belongs_to = [];
        $this->coms_user_does_not_belong_to = [];

        $this->show_poof = false;

        // Apparently, time is sometimes an int and sometimes an array.
        $this->time_bought = [];
        $this->time_sold = [];
        $this->time = [];
        $this->last = [];
        $this->next = [];

        $this->object = null;

        $this->community_object = null;

        $this->message_object = null;

        $this->topic_object = null;

        $this->bitcoin_object = null;

        $this->user_object = null;

        $this->recurring_payment_object = null;

        $this->thing_type = '';

        $this->thing_name = '';

        $this->result = '';

        $this->fields = '';

        $this->present = '';

        $this->array_of_post_objects = [];

        $this->array_of_author_usernames = [];

        $this->array_of_recurring_payment_objects = [];

        $this->array_of_bitcoin_objects = [];

        $this->array_of_objects = [];

        $this->inbox_messages_array = [];

        $this->readable_user_objects_array = [];

        $this->submitted_community_ids_array = [];

        $this->community_array = [];

        $this->account = '';

        $this->account_type = '';

        $this->bank = '';

        $this->chosen_topic_id = 0;

        $this->price_bought = 0;

        $this->price_sold = 0;

        $this->currency_transacted = '';

        $this->commodity_amount = 0;
    }
}