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


class GoodObject
{
// ATTRIBUTES

// METHODS

    /* An object corresponds to a database table row.
     */

    /* Terms:
     * table == database table
     * record == associative array mimicking a table row
     *             - each element's key is a field name
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

    protected function create()
    {

    }

    public function save(\mysqli $db)
    {

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