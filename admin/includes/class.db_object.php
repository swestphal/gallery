<?php

class Db_object
{

    public $upload_errors_array = array(
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
    );

    /**
     * returns true if objects has the given property
     * @param $attribute - property to check
     * @return bool - true if exists
     */
    private function has_the_attribute($attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($attribute, $object_properties);
    }

    /**
     * instantiate the calling class
     * @param $record
     * @return User
     */


    public static function instantiation($record)
    {
        $calling_class = get_called_class();
        $the_object = new $calling_class;
        foreach ($record as $attribute => $value) {
            if ($the_object->has_the_attribute($attribute)) {
                $the_object->$attribute = $value;
            }
        }
        return $the_object;
    }


    protected function get_properties()
    {
        $properties = array();
        foreach (static::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;  // dollar sign before db_field, because its a variable, not a property!
                //  $properties[username] = "mark";
            }
        }
        return $properties;
    }


    protected function clean_properties()
    {
        global $database;
        $clean_properties = array();
        foreach ($this->get_properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }


    /**
     * finds all users
     * @return array - array of objects
     */
    public static function find_all()
    {
        return static::find_this_query("SELECT * FROM " . static::$db_table);
    }


    /**
     * finds user by given id
     * @param $id -   given id
     * @return bool|mixed - false or object
     */
    public static function find_by_id($id)
    {
        $result_set = static::find_this_query("SELECT * FROM " . static::$db_table . " WHERE id=$id LIMIT 1");
        return !empty($result_set) ? array_shift($result_set) : false;

    }

    /**
     * runs query with given query string
     * @param $query - sql query string
     * @return array - object array
     */
    public static function find_this_query($query)
    {
        global $database;
        $result_set = $database->query($query);
        $object_array = array();

        while ($row = $result_set->fetch_assoc()) {
            $object_array[] = static::instantiation($row);
        };
        return $object_array;
    }

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }


    public function create()
    {
        global $database;

        $properties = $this->clean_properties();

        $query = "INSERT INTO " . static::$db_table . " ( ";
        $query .= implode(",", array_keys($properties));
        $query .= ") VALUES (";
        $query .= "'" . implode("','", array_values($properties)) . "'";
        $query .= ")";


        if ($database->query($query)) {
            $this->id = $database->inserted_id();
            return $this->id;
        } else {
            return false;
        }

    }


    public function update()
    {
        global $database;

        $properties = $this->clean_properties();


        $id = $database->escape_string($this->id);

        $key_value_pairs = array();
        foreach ($properties as $property => $value) {
            $key_value_pairs[] = "{$property} = '{$value}'";
        }
        $key_value_string = implode(", ", $key_value_pairs);

        $query = "UPDATE " . static::$db_table . " SET ";
        $query .= $key_value_string;
        $query .= " WHERE id=" . $id;

        $database->query($query);
        return (($database->get_db_con()->affected_rows == 1) ? true : false);

    }


    public function delete()
    {
        global $database;

        $id = $database->escape_string($this->id);
        $query = "DELETE from " . static::$db_table . " ";
        $query .= "WHERE id={$id} ";
        $query .= "LIMIT 1";

        $database->query($query);

        return (($database->get_db_con()->affected_rows == 1) ? true : false);

    }

    public function get_picture_path()
    {

        return $this->upload_directory . "/" . $this->filename;
    }

    public function delete_photo()
    {
        if ($this->delete()) {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->get_picture_path();
            return unlink($target_path) ? true : false;

        } else {
            return false;
        }

    }
}