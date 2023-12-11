<?php

namespace Admin\Classes;

class DB_Object
{
    protected static $db_table;
    protected static $db_table_fields;
    public $id;

    public static function find_all()
    {
        return self::find_this_query("SELECT * FROM " . static::$db_table);
    }

    public static function find_all_users_by_id($id)
    {
        global $database;
        $the_result_array = self::find_this_query("SELECT * FROM " . static::$db_table . " WHERE id = $id LIMIT 1");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }


    public static function find_this_query($sql)
    { //puoi mettere anche tra parentesi tonde $sql
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = [];

        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = self::instantation($row);
        }
        return $the_object_array;
    }


    public static function verify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . static::$db_table . " WHERE";
        $sql .= " username = '{$username}'";
        $sql .= " AND password = '{$password}'";


        $the_result_array = static::find_this_query($sql);

        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function instantation($the_record)
    {
        $calling_call = get_called_class();
        $the_object = new $calling_call;

        // $the_opject->id = $row['id'];
        // $the_opject->username = $row['username'];
        // $the_opject->password = $row['password'];
        // $the_opject->first_name = $row['first_name'];
        // $the_opject->last_name = $row['last_name'];
        foreach ($the_record as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    }

    public function properties()
    {
        $properties = array();
        foreach (static::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }

        return $properties;
    }

    public function save()
    {

        return (isset($this->id)) ? $this->update() : $this->create();
    }

    public function create()
    {
        global $database;
        $properties = $this->clean_proprieties();

        $sql  = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties)) . ")";
        $sql .= " VALUES ('" . implode("', '", array_values($properties)) . "')";
        if ($database->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>";
        }
        //$sql .= $database->escape_string("(" .  implode(",", array_values($properties)) . ")") . "', '";
        //$sql .= $database->escape_string($this->password) . "', '";
        //$sql .= $database->escape_string($this->first_name) . "', '";
        //$sql .= $database->escape_string($this->last_name) . "')";
        //$ciao = print_r($sql);
        //die($ciao);
        //if ($database->query($sql)) {
        //  $this->id = $database->the_insert_id();
        //  return true;
        //} else {
        //  return false;
        //}
        //$database->query($sql);
        //echo '<pre style="background:#23282d;z-index:99999999;color:#78FF5B;font-size:14px;position:relative;">';
        //echo htmlspecialchars( print_r( $sql, true ) );
        //echo htmlspecialchars( print_r( $properties, true ) );
        //echo '</pre>';
    }

    public function update()
    {
        global $database;
        $sql = "UPDATE " . static::$db_table . " SET ";
        $properties = $this->clean_proprieties();
        $properties_pairs = array();
        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key}='{$value}'";
        }

        $sql .= implode(",", $properties_pairs);
        //$sql .= "password='" . $database->escape_string($this->password) . "', ";
        //$sql .= "first_name='" . $database->escape_string($this->first_name) . "', ";
        //$sql .= "last_name='" . $database->escape_string($this->last_name) . "' ";
        $sql .= " WHERE id=" . (int)$this->id;
        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    public function Delete()
    {
        global $database;
        $sql = "DELETE FROM " . static::$db_table . " ";
        $sql .= "WHERE id=" . $database->escape_string($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    private function clean_proprieties()
    {
        global $database;
        $clean_proprieties = array();

        foreach ($this->properties() as $proprety => $value) {
            $clean_proprieties[$proprety] = $database->escape_string($value);
        }

        return $clean_proprieties;
    }

    public function number_photo()
    {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$db_table;
        $result = $database->query($sql);
        $row = mysqli_fetch_array($result);

        return array_shift($row);
    }

    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);

        return array_key_exists($the_attribute, $object_properties);
    }
}
