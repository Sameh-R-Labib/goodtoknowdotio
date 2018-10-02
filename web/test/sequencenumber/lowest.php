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


// Now we begin the code of the function

if (empty($array_of_posts)) {
    echo "Error: The array of posts is empty.";
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
    echo "Error: Anomaly because there can not be no key of lowest.";
}

$post_with_lowest_sequence_number = $array_of_posts[$key_of_lowest];
echo "The post with the lowest sequence number is post #";
echo $post_with_lowest_sequence_number->id;

unset($array_of_posts[$key_of_lowest]);

echo "<br><br>Here is a print_r of \$post_with_lowest_sequence_number";
echo "<pre>";
print_r($post_with_lowest_sequence_number);
echo "</pre>";

echo "<pre>";
echo "<br><br>Here is a print_r of \$array_of_posts. It should be missing the post we removed.";
print_r($array_of_posts);
echo "</pre>";