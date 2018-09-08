<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/31/18
 * Time: 9:44 PM
 *
 * Parent class for all other database object.
 *
 * To create a new object do:
 *   1. Create an associative array containing the attribute names and values.
 *   WARNING: Do Not include id attribute. Do Include all other attributes and assign them values.
 *   2. Call array_to_object($array) to create the object in memory.
 *   3. Save that object to the database using save().
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
     *
     * @param \mysqli $db
     * @return array
     */
    protected function sanitized_attributes(\mysqli $db)
    {
        $clean_attributes = [];

        foreach ($this->attributes() as $key => $value) {
            $clean_attributes[$key] = $db->real_escape_string($value);
        }
        return $clean_attributes;
    }

    /**
     * Returns a newly formulated (in-memory) object based on values gleaned from
     * an array which you provide as parameter.
     *
     * @param array $array
     * @return GoodObject
     */
    public static function array_to_object(array $array)
    {
        $object_in_memory = new static();
        foreach ($array as $key => $value) {
            if ($object_in_memory->has_attribute($key)) {
                $object_in_memory->$key = $value;
            }
        }
        return $object_in_memory;
    }

    /**
     * Returns TRUE if $possible_attribute is one of the attributes of the object.
     * More, specifically it gets an associative array copy of this object's attributes
     * and determines whether $possible_attribute is a key in that array.
     *
     * @param string $possible_attribute
     * @return bool
     */
    protected function has_attribute(string $possible_attribute)
    {
        return array_key_exists($possible_attribute, $this->attributes());
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
     * the attributes of this object AND assigns $this->id.
     *
     * Returns true on success false on failure.
     *
     * This object's id must not be set (!isset())
     * because the id table field is autoincrement.
     *
     * @param \mysqli $db
     * @param string $error
     * @return bool
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
            // Gets array of this object's attributes
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
            $error .= ' GoodObject create() caught a thrown exception: ' . $e->getMessage() . ' ';
        }

        if (!empty($error)) {
            return false;
        }

        if ($num_affected_rows) {
            // Set the id of this object to the insert_id from mysqli.
            $this->id = $insert_id;
            return true;
        } else {
            $error .= ' The GoodObject create() method failed to insert a row. ';
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
     *
     * @param \mysqli $db
     * @param string $error
     * @return bool
     */
    public function save(\mysqli $db, string &$error)
    {
        // A database object without an id is one that has never been saved in the database.
        return isset($this->id) ? $this->update($db, $error) : $this->create($db, $error);
    }

    // Read

    public static function count_all(\mysqli $db, string &$error)
    {
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;

        try {
            $result = $db->query($sql);

            $query_error = $db->error;
            if (!empty($query_error)) {
                $error .= ' The count failed. The reason given by mysqli is: ' . $query_error . ' ';
                return false;
            }
        } catch (\Exception $e) {
            $error .= ' GoodObject count_all() caught a thrown exception: ' . $e->getMessage() . ' ';
        }

        if (!empty($error)) {
            return false;
        }

        if (!$result->num_rows) {
            $error .= ' count_all failed. ';
            return false;
        }

        $row = $result->fetch_row();
        return array_shift($row);
    }

    /**
     * Gives me an array of all the objects.
     * Or gives me false when in error state.
     *
     * @param \mysqli $db
     * @param string $error
     * @return array|bool
     */
    public static function find_all(\mysqli $db, string &$error)
    {
        return static::find_by_sql($db, $error, "SELECT * FROM " . static::$table_name);
    }

    /**
     * Gives me a GoodObject for the id specified.
     *
     * @param \mysqli $db
     * @param string $error
     * @param $id
     * @return bool|mixed
     */
    public static function find_by_id(\mysqli $db, string &$error, $id)
    {
        $result_array = static::find_by_sql($db, $error, "SELECT * FROM " . static::$table_name . "
			WHERE `id`=" . $db->real_escape_string($id) . " LIMIT 1");

        if (!empty($error)) {
            return false;
        }

        return !empty($result_array) ? array_shift($result_array) : false;
    }

    // Make sure to sanitize values used in $sql.
    /**
     * Gives me an array of objects for the sql I give it.
     *
     * @param \mysqli $db
     * @param string $error
     * @param string $sql
     * @return array|bool
     */
    public static function find_by_sql(\mysqli $db, string &$error, string $sql)
    {
        $object_array = [];

        try {
            $result = $db->query($sql);

            $query_error = $db->error;
            if (!empty($query_error)) {
                $error .= ' GoodObject find_by_sql failed. The reason given by mysqli is: ' . $query_error . ' ';
                return false;
            }
        } catch (\Exception $e) {
            $error .= ' GoodObject find_by_sql() caught a thrown exception: ' . $e->getMessage() . ' ';
        }

        if (!empty($error)) {
            return false;
        }

        while ($row = $result->fetch_assoc()) {
            $object_array[] = static::array_to_object($row);
        }
        return $object_array;
    }

    // Update

    /**
     * Basically update() updates the existing database record
     * field values by replacing them with the values found
     * in the attributes of this object.
     *
     * @param \mysqli $db
     * @param string $error
     * @return bool
     */
    protected function update(\mysqli $db, string &$error)
    {
        $num_affected_rows = 0;

        if ($this->id < 1 || !is_numeric($this->id)) {
            $error .= 'GoodObject update() says: Whichever code is calling this method is trying
            to update a table row using an object which has a negative or non-numeric id. ';
            return false;
        }

        try {
            $attributes = $this->sanitized_attributes($db);
            array_shift($attributes);

            /*
             * Sql example for an update:
             *
             * UPDATE table
             * SET column1 = expression1,
             *     column2 = expression2,
             *     ...
             * WHERE conditions;
             *
             * UPDATE customers
             * SET last_name = 'Jefferson'
             * WHERE customer_id = 800;
             *
             */

            // Create an array of the "column = expression" pairs
            $attribute_pairs = [];
            foreach ($attributes as $key => $value) {
                $attribute_pairs[] = "`{$key}`='{$value}'";
            }

            $sql = "UPDATE " . static::$table_name . " SET ";
            $sql .= join(", ", $attribute_pairs);
            $sql .= " WHERE `id`=" . $db->real_escape_string($this->id);

            $db->query($sql);

            $query_error = $db->error;
            if (!empty($query_error)) {
                $error .= ' The update failed. The reason given by mysqli is: ' . $query_error . ' ';
                return false;
            }

            $num_affected_rows = $db->affected_rows;
        } catch (\Exception $e) {
            $error .= ' GoodObject update() threw exception: ' . $e->getMessage() . ' ';
        }

        if ($num_affected_rows == 1) {
            return true;
        } else {
            $error .= ' GoodObject update() FAILED to update its row. ';
            $error .= ' The number of affected rows is ' . $num_affected_rows . '. ';
            return false;
        }
    }

    // Delete
    public function delete()
    {

    }
}