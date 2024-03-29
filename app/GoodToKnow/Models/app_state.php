<?php


namespace GoodToKnow\Models;


use mysqli;

/**
 * Class app_state
 * @package GoodToKnow\Models
 *
 * Gtk.io is an app which gives a response to an HTTP request.
 *
 * routehandler.php is the PHP script for Gtk.io.
 *
 *  $g (where $g is an app_state object) is created by routehandler.php.
 *
 * An app_state object wraps just about all the vars we would want to pass around as globals into one container.
 * This makes it more convenient to declare globals because we won't have to declare each one separately.
 * Simply, declaring global $g within a file or function gives access to all these vars.
 */
class app_state
{
    /**
     * @var string
     */
    public $controller_name;


    /**
     * The system message which is to be displayed.
     *
     * @var string
     */
    public $message;


    /**
     * @var string
     */
    public $url_of_most_recent_upload;

    /**
     * Identification number (id) of the currently logged-in user.
     *
     * @var int
     */
    public $user_id;


    /**
     * Username of currently logged in user.
     *
     * @var string
     */
    public $user_username;


    /**
     * Role of currently logged-in user.
     *
     * @var string
     */
    public $role;


    /**
     * The database record for the current logged-in user specifies the user's default PHP timezone.
     * Initially the session timezone variable gets assigned to a hard coded value in routehandler.php.
     * However, when the user logs in, his default timezone value will be assigned to both $g->timezone
     * and session timezone.
     *
     * @var string
     */
    public $timezone;


    /**
     * id of the current community.
     *
     * @var int|mixed
     */
    public $community_id;


    /**
     * Name of the current community.
     *
     * @var string
     */
    public $community_name;


    /**
     * Description of the current community.
     *
     * @var string
     */
    public $community_description;


    /**
     * A "special" array representing the communities of the user.
     *
     * @var array
     */
    public $special_community_array;


    /**
     * Identification number of the current topic.
     *
     * @var int|mixed
     */
    public $topic_id;


    /**
     * Name of the current topic.
     *
     * @var string
     */
    public $topic_name;


    /**
     * Description of the current topic.
     *
     * @var string
     */
    public $topic_description;


    /**
     * Identification number of the current post.
     *
     * @var int|mixed
     */
    public $post_id;


    /**
     * Name of the current post.
     *
     * @var string
     */
    public $post_name;


    /**
     * The extended title plus the date for the current post.
     *
     * @var string
     */
    public $post_full_name;


    /**
     * The name of the type of thing currently earmarked to be displayed
     * on the home page.
     *
     * Possible values are: 'community', 'topic', 'post', 'topic_or_post'
     *
     * @var string
     */
    public $type_of_resource_requested;


    /**
     * A "special" array representing the topics in the current community.
     *
     * @var array
     */
    public $special_topic_array;


    /**
     * A "special" array representing the posts in the current topic.
     *
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
     * The content of the current post.
     *
     * @var string
     */
    public $post_content;


    /**
     * The username of the author of the current post.
     *
     * @var string
     */
    public $author_username;


    /**
     * Identification number of the author of the current post.
     *
     * @var int|mixed
     */
    public $author_id;


    /**
     * @var int
     */
    public $when_last_checked_suspend;


    /**
     * @var int
     */
    public $when_last_checked_system_status_offline;


    /**
     * @var int
     */
    public $when_last_checked_system_alert;


    /**
     * @var int|null
     */
    public $messages_last_quantity;


    /**
     * @var int|null
     */
    public $when_last_checked_messages;


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
     * @var array
     */
    public $saved_arr02;


    /**
     * @var array
     */
    public $saved_arr03;


    /**
     * @var bool
     */
    public $is_logged_in;


    /**
     * Evaluates to true if (when the constructor is called) $this->role === 'admin'.
     *
     * @var bool
     */
    public $is_admin;


    /**
     * Indicates whether the person viewing the page is viewing it as a user of
     * the system. When $is_guest == true then we want the view to shows stuff intended
     * for visitors to see. The controller will set $is_guest appropriately.
     *
     * $is_guest default to false.
     *
     * @var bool
     */
    public $is_guest;


    /**
     * The value of $page determines what is to be shown in breadcrumbs.
     *
     * @var string
     */
    public $page;


    /**
     * Text for <title> HTML tag.
     *
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
     * Whether to show a poof rather than a link to
     * the route for messaging the author of the current post.
     *
     * Convention:
     * ===========
     * $g->show_poof default is false.
     * Every route which ends in a view must explicitly set
     * the correct value for $g->show_poof.
     * Although show_poof is a session variable we do not use
     * the session to assign its value.
     *
     * @var bool
     */
    public $show_poof;


    /**
     * @var array|int
     */
    public $time_bought;


    /**
     * @var string
     */
    public $time_bought_date;


    /**
     * @var int
     */
    public $time_bought_hour;


    /**
     * @var int
     */
    public $time_bought_minute;


    /**
     * @var int
     */
    public $time_bought_second;


    /**
     * @var array|int
     */
    public $time_sold;


    /**
     * @var string
     */
    public $time_sold_date;


    /**
     * @var int
     */
    public $time_sold_hour;


    /**
     * @var int
     */
    public $time_sold_minute;


    /**
     * @var int
     */
    public $time_sold_second;


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
    public $commodity_object;


    /**
     * @var null|object
     */
    public $user_object;


    /**
     * @var null|object
     */
    public $recurring_payment_object;


    /**
     * @var null|object
     */
    public $post_object;


    /**
     * @var null|object
     */
    public $post_author_object;


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
    public $array_of_commodity_objects;


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
    public $chosen_post_id;


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
     * @var string
     */
    public $commodity_type;


    /**
     * @var string
     */
    public $commodity_label;


    /**
     * @var int
     */
    public $tax_year;


    /**
     * @var float
     */
    public $profit;


    /**
     * @var null|mysqli
     */
    public $db;


    /**
     * @var bool
     */
    public $is_first_attempt;


    /**
     * @var string
     */
    public $last_date;


    /**
     * @var string
     */
    public $next_date;


    /**
     * @var int
     */
    public $last_hour;


    /**
     * @var int
     */
    public $next_hour;


    /**
     * @var int
     */
    public $last_minute;


    /**
     * @var int
     */
    public $next_minute;


    /**
     * @var int
     */
    public $last_second;


    /**
     * @var int
     */
    public $next_second;


    /**
     * @var string
     */
    public $date;


    /**
     * @var int
     */
    public $hour;


    /**
     * @var int
     */
    public $minute;


    /**
     * @var int
     */
    public $second;


    /**
     * @var string
     */
    public $action;


    /**
     * @var string
     */
    public $heading_one;


    /**
     * @var string
     */
    public $messages_button;


    /**
     * @var string
     */
    public $the_buttons;


    /**
     * app_state constructor.
     */
    function __construct()
    {
        /**
         * Extractors from $_SESSION
         */

        // We erase $_SESSION['message'] after reading it to make sure the message doesn't unintentionally
        // last beyond this request / response cycle. However, sometimes we do want the message to
        // last beyond this request / response cycle.

        $this->message = (isset($_SESSION['message'])) ? $_SESSION['message'] : '';
        $_SESSION['message'] = '';

        // We do want the rest of these session related vars to last throughout each particular series
        // of request / response cycles (the  series which make up a feature like for example "Create a bank transaction".)
        // These vars get erased via call to reset_feature_session_vars() inside of breakout().

        $this->url_of_most_recent_upload = (isset($_SESSION['url_of_most_recent_upload'])) ? $_SESSION['url_of_most_recent_upload'] : '';

        $this->user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 0;

        $this->user_username = (isset($_SESSION['user_username'])) ? $_SESSION['user_username'] : '';

        $this->role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '';

        $this->timezone = (isset($_SESSION['timezone'])) ? $_SESSION['timezone'] : 'America/New_York';

        $this->community_id = (isset($_SESSION['community_id'])) ? $_SESSION['community_id'] : 0;

        $this->community_name = (isset($_SESSION['community_name'])) ? $_SESSION['community_name'] : '';

        $this->community_description = (isset($_SESSION['community_description'])) ? $_SESSION['community_description'] : '';

        // The term "special" refers to the fact that the key of the array elements is an id
        // and the value of the array is a name which corresponds to that id.
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

        $this->when_last_checked_system_status_offline = (isset($_SESSION['when_last_checked_system_status_offline'])) ? $_SESSION['when_last_checked_system_status_offline'] : 1554825315;

        $this->when_last_checked_system_alert = (isset($_SESSION['when_last_checked_system_alert'])) ? $_SESSION['when_last_checked_system_alert'] : 1554825315;

        $this->messages_last_quantity = (isset($_SESSION['messages_last_quantity'])) ? $_SESSION['messages_last_quantity'] : null;

        $this->when_last_checked_messages = (isset($_SESSION['when_last_checked_messages'])) ? $_SESSION['when_last_checked_messages'] : null;

        // Is this the first time the form was submitted while trying to use the feature?
        // That is what 'is_first_attempt' means.
        $this->is_first_attempt = (isset($_SESSION['is_first_attempt'])) ? $_SESSION['is_first_attempt'] : true;

        $this->saved_str01 = (isset($_SESSION['saved_str01'])) ? $_SESSION['saved_str01'] : '';

        $this->saved_str02 = (isset($_SESSION['saved_str02'])) ? $_SESSION['saved_str02'] : '';

        $this->saved_int01 = (isset($_SESSION['saved_int01'])) ? $_SESSION['saved_int01'] : 0;

        $this->saved_int02 = (isset($_SESSION['saved_int02'])) ? $_SESSION['saved_int02'] : 0;

        $this->saved_arr01 = (isset($_SESSION['saved_arr01'])) ? $_SESSION['saved_arr01'] : [];

        $this->saved_arr02 = (isset($_SESSION['saved_arr02'])) ? $_SESSION['saved_arr02'] : [];

        $this->saved_arr03 = (isset($_SESSION['saved_arr03'])) ? $_SESSION['saved_arr03'] : [];

        $this->is_logged_in = (isset($_SESSION['is_logged_in'])) ? $_SESSION['is_logged_in'] : false;


        /**
         * To Make Things Look More Simple
         */

        $this->is_admin = $this->role === 'admin';

        // When is_guest is set to true it tells some Gtk.io views to show the version of parts of the page which
        // non-authenticated users should see and hide the parts which they should not see.
        if (!$this->is_logged_in) {
            $this->is_guest = true;
        } else {
            $this->is_guest = false;
        }


        /**
         * Globalizes - initializes vars which are to be declared global.
         *
         * In other words:  This is the central home base place where we initialize app state globals.
         *
         * Our standard practice: $g (an app_state object), and also with all globals in general, shall be declared
         *                        global in every file that uses that global.
         */

        $this->action = '';

        $this->heading_one = '';

        $this->page = 'home';

        $this->html_title = '';

        $this->long_title_of_post = '';

        $this->pre_populate = '';

        $this->array = [];

        $this->markdown = '';

        // coms_user_belongs_to is a temporary var used for managing any user's communities.
        $this->coms_user_belongs_to = [];
        $this->coms_user_does_not_belong_to = [];

        // See the convention stated above.
        $this->show_poof = false;

        // Apparently, time is sometimes an int and sometimes an array.
        $this->time_bought = [];
        $this->time_sold = [];
        $this->time = [];
        $this->last = [];
        $this->next = [];

        // time
        $this->date = '';
        $this->hour = 0;
        $this->minute = 0;
        $this->second = 0;

        // time_bought
        $this->time_bought_date = '';
        $this->time_bought_hour = 0;
        $this->time_bought_minute = 0;
        $this->time_bought_second = 0;

        // time_sold
        $this->time_sold_date = '';
        $this->time_sold_hour = 0;
        $this->time_sold_minute = 0;
        $this->time_sold_second = 0;

        // last
        $this->last_date = '';
        $this->last_hour = 0;
        $this->last_minute = 0;
        $this->last_second = 0;

        // next
        $this->next_date = '';
        $this->next_hour = 0;
        $this->next_minute = 0;
        $this->next_second = 0;

        $this->object = null;

        $this->community_object = null;

        $this->message_object = null;

        $this->topic_object = null;

        $this->commodity_object = null;

        $this->user_object = null;

        $this->recurring_payment_object = null;

        $this->post_object = null;

        $this->post_author_object = null;

        $this->thing_type = '';

        $this->thing_name = '';

        $this->result = '';

        $this->fields = '';

        $this->present = '';

        $this->array_of_post_objects = [];

        $this->array_of_author_usernames = [];

        $this->array_of_recurring_payment_objects = [];

        $this->array_of_commodity_objects = [];

        $this->array_of_objects = [];

        $this->inbox_messages_array = [];

        $this->readable_user_objects_array = [];

        $this->submitted_community_ids_array = [];

        $this->community_array = [];

        $this->messages_button = '';

        $this->the_buttons = '';

        $this->account = '';

        $this->account_type = '';

        $this->bank = '';

        $this->chosen_topic_id = 0;

        $this->chosen_post_id = 0;

        $this->price_bought = 0;

        $this->price_sold = 0;

        $this->currency_transacted = '';

        $this->commodity_amount = 0;

        $this->commodity_type = '';

        $this->commodity_label = '';

        $this->tax_year = 0;

        $this->profit = 0.0;

        // ★ ★ ★
        $this->db = null;
        // ★ ★ ★
    }
}