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

    public $tmp_path;
    public $size;
    public $errors = array();
    public $upload_directory = "user_images";
    public $image_placeholder = "http://placehold.it/150x150&text=image";

    public function set_file($file)
    {
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->user_image = basename($file['name']);
//            $this->user_image = $file['name'];
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
        return false;
    }

    public function save_user_and_image()
    {
//            if (!empty($this->errors)) {
//                return false;
//            }
            if (empty($this->user_image) || empty($this->tmp_path)) {
                $this->errors[] = "the file was not available";
                return false;
            }
            $target_path = $this->upload_directory . DS . $this->user_image;
            if (file_exists($target_path)) {
                $this->errors[] = "The file {$this->user_image} already exists";
                return false;
            }
            if (move_uploaded_file($this->tmp_path, $target_path)) {
                if ($this->save()) {
                    unset($this->tmp_path);
                    return true;
                }
            } else {
                $this->errors[] = "the file directory does probably not have the right permission";
                return false;
            }
        }


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