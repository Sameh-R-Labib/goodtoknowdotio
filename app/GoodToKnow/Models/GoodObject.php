<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/31/18
 * Time: 9:44 PM
 *
 * Parent class for all other database object.
 */

namespace GoodToKnow\Models;


abstract class GoodObject
{
// ATTRIBUTES
    public $id; // I have this so phpstorm won't mark id as undefined in this class.

// METHODS

    /* An object corresponds to a database table row.
     */

    /* Terms:
     * table == database table
     * record == associative array mimicking a table row
     *             - each element's key represents a field name
     *             - each element's value the corresponding value
     * object == objectified record
     * array == array of records
     * field == static::$db_fields $field
     */

    // Class Helpers

    private static function instantiate($record)
    {

    }

    public function attributes()
    {

    }

    protected function sanitized_attributes()
    {

    }

    private function has_attribute($attribute)
    {

    }

    //~~~
    // CRUD (Create Read Update Delete)

    // Create

    /**
     * WARNING: This method will fail if the object you are trying
     * to insert in the table does not have ALL its attributes set
     * to VALID values.
     *
     * Creates/Inserts a new row in the table based on
     * the attributes of this in memory object.
     *
     * Returns true on success false on failure.
     *
     * This in memory object must not have an id value
     * since the id table field is autoincrement.
     */
    protected function create(\mysqli $db, string &$error)
    {
        $num_affected_rows = 0;
        $insert_id = 0;

        if ($this->id) {
            $error .= ' GoodObject create() method says: Whichever code is calling create() is trying
            to insert a new table row using an object which already exists in the table. We know this
            because that object already has an id. ';
            return false;
        }

        try {

        } catch (\Exception $e) {
            $error .= ' GoodObject create() method caught a thrown exception: ' . $e->getMessage() . ' ';
        }
    }

    /**
     * This function takes a database object and saves its
     * data to the database.
     * This function behaves differently depending on whether
     * or not the database object being saved is new to the database.
     * This function is a wrapper for update() and create().
     * Basically, it runs update() if isset($this->id).
     * Otherwise, it runs create().
     */
    public function save(\mysqli $db, string &$error)
    {
        // A database object without an id is one that has never been saved in the database.
        return isset($this->id) ? $this->update($db, $error) : $this->create($db, $error);
    }

    // Read

    public static function count_all()
    {

    }

    public static function find_all()
    {

    }

    public static function find_by_id($id = 0)
    {

    }

    public static function find_by_sql($sql = "")
    {

    }

    // Update

    protected function update()
    {

    }

    // Delete
    public function delete()
    {

    }
}