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


// main 1

$post01 = new Post;
$post01->id = 1;
$post01->sequence_number = 500000;

$post02 = new Post;
$post02->id = 2;
$post02->sequence_number = 750000;

$post03 = new Post;
$post03->id = 3;
$post03->sequence_number = 0;

$post04 = new Post;
$post04->id = 4;
$post04->sequence_number = 1000000;

$post05 = new Post;
$post05->id = 5;
$post05->sequence_number = 875000;

$array_of_posts = [$post02, $post01, $post04, $post05, $post03];

/**
 * Can order_posts_by_sequence_number take $array_of_posts
 * and return an array of posts which is ordered by sequence
 * number from lowest to highest?
 */
echo "<p>Here is the original array of posts: </p>";
echo "<pre>";
print_r($array_of_posts);
echo "</pre>";
$result = order_posts_by_sequence_number($array_of_posts);
if ($result) {
    echo "<p>order_posts_by_sequence_number returned true</p>";
} else {
    echo "<p>order_posts_by_sequence_number returned false</p>";
}
echo "<p>Here is the sorted array of posts: </p>";
echo "<pre>";
print_r($array_of_posts);
echo "</pre>";