<?php
class Users extends DB_object
{
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image',);
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $upload_directory = 'images';
    public $image_placeholder = 'http://placehold.it/62x62&text=image';
    protected static $db_table = "users";

    private $tmp_path, $type_user, $size_user;

    public function image_path_and_placeholder()
    {
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
    }

    public function set_file($file)
    {
        if (empty($file) || !$file || !is_array($file)) {

            return false;
        } elseif ($file['error'] != 0) {

            return false;
        } else {

            $this->user_image = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type_user = $file['type'];
            $this->size_user = $file['size'];
            $this->save();
        }
    }

    public function save_user_and_image()
    {
        if (move_uploaded_file($this->tmp_path, $this->upload_directory . DS . $this->user_image)) {
            if ($this->create()) {
                unset($tmp_path);
                return true;
            } else {

                return false;
            }
        }
    }
}
