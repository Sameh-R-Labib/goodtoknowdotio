<?php

use GoodToKnow\Models\MessageToUser;

global $messages_last_quantity;

global $messages_last_time;

if ($messages_last_time === null) {
    if ($db == 'not connected') {
        $db = db_connect($sessionMessage);

        if ($db === false) {
            $sessionMessage .= " Failed to connect to the database. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/InfiniteLoopPrevent/page");
        }
    }

    $quantity = MessageToUser::user_message_quantity($db, $sessionMessage, $user_id);

    if ($quantity === false) {
        $sessionMessage .= " Failed to get quantity of messages. ";
        $_SESSION['message'] = $sessionMessage;
        reset_feature_session_vars();
        redirect_to("/ax1/InfiniteLoopPrevent/page");
    }

    $sessionMessage .= " <br><br>You have {$quantity} messages.
    <img src=\"\mdollnaery.gif\" alt=\"Smiley face\" height=\"35px\"> ";

    $_SESSION['messages_last_quantity'] = $quantity;
    $_SESSION['messages_last_time'] = time();
} else {
    $time_since_last = time() - $messages_last_time;
    $time_since_last = $time_since_last / 60;


    /**
     * Debug Code
     */
    echo "\n<p>Begin debug</p>\n";
    echo "<p>Var_dump \$time_since_last: </p>\n<pre>";
    var_dump($time_since_last);
    echo "</pre>\n";
    die("<p>End debug</p>\n");




    if ($time_since_last > 17) {
        $quantity = MessageToUser::user_message_quantity($db, $sessionMessage, $user_id);

        if ($quantity === false) {
            $sessionMessage .= " Failed to get quantity of messages. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/InfiniteLoopPrevent/page");
        }

        $quantity_new = $quantity - $messages_last_quantity;

        if ($quantity > $messages_last_quantity) {
            $sessionMessage .= " You have {$quantity} messages. {$quantity_new} messages are new.
            <img src=\"\mdollnaery.gif\" alt=\"Smiley face\" height=\"35px\"> ";

            $_SESSION['messages_last_quantity'] = $quantity;
            $_SESSION['messages_last_time'] = time();
        }
    }
}