<?php


class User extends Db_object
{

    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name',"user_image");
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $upload_directory = "user_images";
    public $image_placeholder = "http://placehold.it/150x150&text=image";


    public function get_user_image() {
    return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
    }

    public static function verify_user($username, $password)
    {

        $query = "SELECT * FROM " . self::$db_table . " ";
        $query .= "WHERE username = '{$username}' ";
        $query .= " AND password='{$password}' ";


        $result_array = self::find_this_query($query);
        if (!empty($result_array)) {
            $first_item = array_shift($result_array);
            return $first_item;
        } else return false;
    }

    public function delete_user()
    {
        if ($this->delete()) {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->get_user_image();
            return unlink($target_path) ? true : false;

        } else {
            return false;
        }

    }
}