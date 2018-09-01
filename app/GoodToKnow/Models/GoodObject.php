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
// ATTRIBUTES (all are dummies/abstract)
    public $id;
    protected static $fields = ['id'];
    protected static $table_name = "goodobjects";

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

    /**
     * Returns an associative ARRAY which mimics the objects attributes.
     *
     * attributes() will get an ARRAY element for every field specified in $fields.
     * However, if that field doesn't have a matching value in the object then the value
     * assigned to the element will be an empty string. In every case we will have
     * an id as the first field. So, this rule will always apply to new objects.
     *
     * attributes() won't get an ARRAY element that's not for a property for the class
     * of this object.
     */
    public function attributes()
    {
        $attributes = [];
        foreach (static::$fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    /**
     * Gets db-escaped attributes (as array) from this object.
     * These attributes may (or may not) include the id attribute
     */
    protected function sanitized_attributes(\mysqli $db)
    {
        $clean_attributes = [];

        foreach ($this->attributes() as $key => $value) {
            $clean_attributes[$key] = $db->real_escape_string($value);
        }
        return $clean_attributes;
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
     * the attributes of this object.
     *
     * Returns true on success false on failure.
     *
     * This object's id must not be set (!isset())
     * because the id table field is autoincrement.
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
            $attributes = $this->sanitized_attributes($db);

            // Pop off the first element
            $array_keys_array = array_keys($attributes);
            array_shift($array_keys_array);
            $array_values_array = array_values($attributes);
            array_shift($array_values_array);

            $sql = 'INSERT INTO ' . static::$table_name;
            $sql .= " (`" . join("`, `", $array_keys_array) . "`) VALUES ('";
            $sql .= join("', '", $array_values_array) . "')";

            $db->query($sql);

            $query_error = $db->error;
            if (!empty($query_error)) {
                $error .= ' The insert failed. The reason given by mysqli is: ' . $query_error . ' ';
                return false;
            }

            $num_affected_rows = $db->affected_rows;
            $insert_id = $db->insert_id;
        } catch (\Exception $e) {
            $error .= ' GoodObject create() method caught a thrown exception: ' . $e->getMessage() . ' ';
        }

        if (!empty($error)) {
            return false;
        }

        if ($num_affected_rows) {
            // Set the id of this object to the insert_id from mysqli.
            $this->id = $insert_id;
            return true;
        } else {
            $error .= ' The DocTitle create() method failed to insert a row. ';
            return false;
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