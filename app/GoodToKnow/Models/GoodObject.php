<?php
/**
 * Parent class for all other database object.
 *
 * To create a new object do:
 *   1. Create an associative array containing ALL the attribute names
 *      and values **other than 'id'.**
 *      (WARNING: Do Not include id attribute.)
 *   2. Call array_to_object($array) to create the object in memory.
 *   3. Save that object to the database using save().
 *
 * Manually sanitize SQL variable values
 * when using find_by_sql(). If you code
 * other methods for this class or its
 * children make sure you sanitize.
 *
 * Sanitizing prepares sql variable values
 * for use in sql.
 */

namespace GoodToKnow\Models;


use Exception;
use mysqli;


abstract class GoodObject
{
// ATTRIBUTES (all are dummies/abstract)

    public $id;

    // (In the $fields array below) The id field must be
    // specified before all the other fields.

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
     * Returns an associative ARRAY which mimics the object's attributes.
     * In other words attributes() gives you the array version of the object
     * on which you call the function.
     *
     * attributes() will get an ARRAY element for every field specified in $fields which
     * has a matching attribute / property in the class definition.
     * However, if an attribute was not assigned a value then the value assigned
     * for that element will be null. For every object we will have
     * an id. So, null will be the value in the array element for id
     * when the object is new.
     *
     * attributes() only returns array elements which correspond to an attribute that has
     * both a $fields presence and an actual attribute declaration in the class.
     */

    /**
     * @return array
     */
    public function attributes(): array
    {
        $attributes = [];

        foreach (static::$fields as $field) {

            // property_exists — Checks if the object or class has a property.
            // As opposed with isset(), property_exists() returns true
            // even if the property has the value null.
            if (property_exists($this, $field)) {

                $attributes[$field] = $this->$field;

            }
        }

        return $attributes;
    }


    /**
     * Gets db-escaped value attributes (as associative array) of this object.
     *
     * @param mysqli $db
     * @return array
     */
    protected function sanitized_attributes(mysqli $db): array
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
    public static function array_to_object(array $array): GoodObject
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
    protected function has_attribute(string $possible_attribute): bool
    {
        return array_key_exists($possible_attribute, $this->attributes());
    }


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
     * @param mysqli $db
     * @param string $error
     * @return bool
     */
    protected function create(mysqli $db, string &$error): bool
    {
        if ($this->id) {

            $error .= ' GoodObject create() method says: Whichever code is calling create() is trying
            to insert a new table row using an object which already exists in the table. We know this
            because that object already has an id. ';

            return false;

        }

        try {
            // Get an array of this object's attributes.
            // Yes, id will be included in this array as will
            // all the other fields. If the field hadn't been
            // assigned a value then an empty string will be its value.

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

                $error .= ' The insert failed. The reason given by mysqli is: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ';

                return false;
            }

            $num_affected_rows = $db->affected_rows;

            $insert_id = $db->insert_id;

        } catch (Exception $e) {

            $error .= ' GoodObject create() caught a thrown exception: ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';

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
     * WARNING: This method will fail if the objects you are trying
     * to insert in the table do not have ALL their attributes set
     * to VALID values.
     *
     * @param mysqli $db
     * @param string $error
     * @param array $objects_array
     * @return bool
     */
    public static function insert_multiple_objects(mysqli $db, string &$error, array $objects_array): bool
    {
        /**
         * Unlike create() (AFTER it executes) this function will NOT set id field values to the objects.
         * It is assumed that the objects have unassigned id fields and do NOT exist in the database.
         * The function returns true on success and false if no objects were inserted.
         */

        $sql = 'INSERT INTO ' . static::$table_name;

        if (empty($objects_array)) {

            $error .= ' The function insert_multiple_objects did NOT receive any objects to insert. ';

            return false;

        }

        try {
            /**
             * I'm going to use the first object
             * to get the field names and have
             * them be in the correct order.
             *
             * $attributes is an array whose elements
             * are the attributes of the first object.
             * The key is the attribute name and the
             * value is the attribute value.
             */

            $attributes = $objects_array[0]->attributes();

            $array_keys_array = array_keys($attributes);

            array_shift($array_keys_array);

            // Now $array_keys_array contains the field names. And they are in correct order.

            $sql .= " (`" . join("`, `", $array_keys_array) . "`) VALUES ";
            $sql .= static::value_sets_sql_string($db, $objects_array);

            $db->query($sql);

            $query_error = $db->error;

            if (!empty($query_error)) {

                $error .= ' The insert failed. The reason given by mysqli is: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ';

                return false;

            }

            $num_affected_rows = $db->affected_rows;

        } catch (Exception $e) {

            $error .= ' GoodObject insert_multiple_objects() caught an exception: ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';

            return false;

        }

        if ($num_affected_rows) {

            return true;

        } else {

            $error .= ' GoodObject insert_multiple_objects() failed to insert any rows. ';

            return false;

        }
    }

    /**
     * @param mysqli $db
     * @param array $objects_array
     * @return string
     */
    public static function value_sets_sql_string(mysqli $db, array $objects_array)
    {
        /**
         * Takes an array of objects and forms
         * the sql values string for a multi object
         * insert sql statement.
         */

        $sql = '';

        $array_key_last = count($objects_array) - 1;

        foreach ($objects_array as $key => $object) {

            $is_last = ($key === $array_key_last) ? true : false;

            $sql .= static::value_sql_for_object($db, $object, $is_last);

        }

        return $sql;
    }


    /**
     * @param mysqli $db
     * @param object $object
     * @param bool $is_last
     * @return string
     */
    public static function value_sql_for_object(mysqli $db, object $object, bool $is_last)
    {
        /**
         * This function helps function value_sets_sql_string
         * in that it produces the value sql for an object.
         * Remember we're doing all this to put together
         * a multi insert sql statement.
         */

        $attributes = $object->sanitized_attributes($db);


        // Pop off the first element

        $array_values_array = array_values($attributes);

        array_shift($array_values_array);

        $sql = "('" . join("', '", $array_values_array) . "')";

        if (!$is_last) $sql .= ", ";

        return $sql;
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
     * @param mysqli $db
     * @param string $error
     * @return bool
     */
    public function save(mysqli $db, string &$error)
    {
        // A database object without an id is one that has never been saved in the database.

        return isset($this->id) ? $this->update($db, $error) : $this->create($db, $error);
    }


    // Read

    /**
     * @param mysqli $db
     * @param string $error
     * @return bool|mixed
     */
    public static function count_all(mysqli $db, string &$error)
    {
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;

        try {
            $result = $db->query($sql);

            $query_error = $db->error;

            if (!empty(trim($query_error))) {

                $error .= ' The count failed. The reason given by mysqli is: ' . $query_error . ' ';

                return false;

            }
        } catch (Exception $e) {

            $error .= ' GoodObject count_all() caught a thrown exception: ' . $e->getMessage() . ' ';

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
     * @param mysqli $db
     * @param string $error
     * @return array|bool
     */
    public static function find_all(mysqli $db, string &$error)
    {
        return static::find_by_sql($db, $error, "SELECT * FROM " . static::$table_name);
    }


    /**
     * Gives me a GoodObject for the id specified.
     *
     * @param mysqli $db
     * @param string $error
     * @param $id
     * @return bool|mixed
     */
    public static function find_by_id(mysqli $db, string &$error, $id)
    {
        $result_array = static::find_by_sql($db, $error, "SELECT * FROM " . static::$table_name . "
			WHERE `id`=" . $db->real_escape_string($id) . " LIMIT 1");

        return !empty($result_array) ? array_shift($result_array) : false;
    }


    // Make sure to sanitize values used in $sql.

    // CAVEAT: It returns field values ONLY as strings.
    //         If this is not acceptable then create a
    //         custom Read method for the child class
    //         which uses prepared statement mysqli functions.
    /**
     * Gives me an array of objects for the sql I give it.
     *
     * @param mysqli $db
     * @param string $error
     * @param string $sql
     * @return array|bool
     */
    public static function find_by_sql(mysqli $db, string &$error, string $sql)
    {
        $object_array = [];

        try {
            $result = $db->query($sql);

            $query_error = $db->error;

            if (!empty(trim($query_error))) {

                $error .= ' GoodObject find_by_sql failed. The reason given by mysqli is: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ';

                return false;

            }
        } catch (Exception $e) {

            $error .= ' GoodObject find_by_sql() caught a thrown exception: ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';

            return false;

        }

        while ($row = $result->fetch_assoc()) {

            $object_array[] = static::array_to_object($row);

        }

        if (empty($object_array)) {

            return false;

        }

        return $object_array;
    }


    // Update

    /**
     * Basically update() updates the existing database record
     * field values by replacing them with the values found
     * in the attributes of this object.
     *
     * @param mysqli $db
     * @param string $error
     * @return bool
     */
    protected function update(mysqli $db, string &$error)
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
            $sql .= " WHERE `id`=" . $db->real_escape_string($this->id) . " LIMIT 1";

            $db->query($sql);

            $query_error = $db->error;

            if (!empty(trim($query_error))) {

                $error .= ' The update failed. The reason given by mysqli is: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ';

                return false;
            }

            $num_affected_rows = $db->affected_rows;

        } catch (Exception $e) {

            $error .= ' GoodObject update() threw exception: ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';

        }

        if ($num_affected_rows == 1) {

            return true;

        } else {

            // It is normal to fail to update whenever the new data is the same as the existing data in the database.
            // $error .= ' GoodObject update() FAILED to update its row. ';

            return false;

        }
    }


    // Delete

    /**
     * @param mysqli $db
     * @param string $error
     * @return bool
     */
    public function delete(mysqli $db, string &$error)
    {
        $num_affected_rows = 0;

        $sql = "DELETE FROM " . static::$table_name . " ";
        $sql .= "WHERE `id`=" . $db->real_escape_string($this->id);
        $sql .= " LIMIT 1";

        try {
            $db->query($sql);

            $query_error = $db->error;

            if (!empty(trim($query_error))) {

                $error .= ' The delete failed. The reason given by mysqli is: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ';

                return false;

            }

            $num_affected_rows = $db->affected_rows;

        } catch (Exception $e) {

            $error .= ' GoodObject delete() caught a thrown exception: ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';

        }

        if ($num_affected_rows == 1) {

            return true;

        } else {

            $error .= ' GoodObject delete() FAILED to delete a row. ';

            return false;

        }
    }
}