<?php
/**
 * Testing (in general) the code for finding a sequence number for the new post.
 * Testing (specifically) the code for post_having_lowest_sequence_number.
 * I will make a modified version of the code I'm testing.
 * The modifications are so that the code can work in this testing
 * environment.
 */

/**
 * The code starts off with an array of post objects.
 * These post objects all belong to one topic.
 * Hence their sequence_number make sense in that context.
 *
 * The code finds the post which has the lowest sequence number
 * and removes it from the array of post objects.
 */
// Make the array of post objects
class Post
{
    public $id;
    public $sequence_number;
}

// Now we begin the code of the function
function post_having_lowest_sequence_number(array &$array_of_posts)
{
    if (empty($array_of_posts)) {
        echo "Error: The array of posts is empty.";
        return false;
    }

    $key_of_lowest = -1;
    $lowest_sequence_number = 1000001;

    foreach ($array_of_posts as $key => $object) {
        if ($object->sequence_number <= $lowest_sequence_number) {
            $key_of_lowest = $key;
            $lowest_sequence_number = $object->sequence_number;
        }
    }

    if ($key_of_lowest == -1) {
        echo "post_having_lowest_sequence_number says: Anomaly because there can not be no key of lowest.";
        return false;
    }

    $post_with_lowest_sequence_number = $array_of_posts[$key_of_lowest];
    unset($array_of_posts[$key_of_lowest]);

    return $post_with_lowest_sequence_number;
}

function order_posts_by_sequence_number(array &$post_objects)
{
    if (empty($post_objects)) {
        echo "order_posts_by_sequence_number says: The array of posts is empty.";
        return false;
    }
    $sorted = [];
    $count = count($post_objects);
    $temp = $post_objects;
    while ($count > 0) {
        $sorted[] = post_having_lowest_sequence_number($temp);
        $count -= 1;
    }
    $post_objects = $sorted;
    return true;
}

function get_sequence_number_in_case_after(array $all_posts_as_objects, int $chosen_post_sequence_number)
{
    /**
     * What it does:
     *  It takes an array of posts belonging to a single topic.
     *  It takes the sequence number from the chosen post.
     *  It assumes the user wants to put the new post after the chosen post.
     *  It returns the sequence number which the new post should have.
     */

    $found_a_post_with_higher_sequence_number = false;
    foreach ($all_posts_as_objects as $key => $object) {
        if ($object->sequence_number > $chosen_post_sequence_number) {
            $found_a_post_with_higher_sequence_number = true;
        }
    }
    if (!$found_a_post_with_higher_sequence_number) {
        $following_post_sequence_number = 1000000;
    }

    order_posts_by_sequence_number($all_posts_as_objects);

    if ($found_a_post_with_higher_sequence_number) {
        foreach ($all_posts_as_objects as $key => $object) {
            if ($object->sequence_number > $chosen_post_sequence_number) {
                $following_post_sequence_number = $object->sequence_number;
                break;
            }
        }
    }

    if (empty($following_post_sequence_number)) {
        echo "get_sequence_number_in_case_after says:  Error 734516..";
        return false;
    }

    $difference = $following_post_sequence_number - $chosen_post_sequence_number;

    if (($difference) < 2) {
        echo "get_sequence_number_in_case_after says: Choose another place to put the post. ";
        return false;
    }

    $increase = intdiv($difference, 2);

    return $chosen_post_sequence_number + $increase;
}


// main 1
