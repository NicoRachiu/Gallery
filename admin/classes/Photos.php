<?php
include("DB_Object.php");
class Photos extends DB_Object
{
    public $id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;
    public $alternative_text;
    public $caption;
    public $tmp_path;
    public $upload_directory = "images";
    public $errors = [];

    public $upload_errors_array = [

        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize di",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX FILE SIZE directiv",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload.",

    ];
    protected static $db_table = "photos";
    protected static $db_table_fields = ['id', 'title', 'caption', 'description', 'last_name', 'filename', 'alternative_text', 'type', 'size'];

    public function set_file($file)
    {
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "NOTHING";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {

            $this->filename = basename($file['name']);
            $this->tmp_path = ($file['tmp_name']);
            $this->type = $file['type'];
            $this->size = $file['size'];
            return $this->save();
        }
    }

    public function picture_path()
    {
        return $this->upload_directory . DS . $this->filename;
    }

    public function save()
    {
        if (move_uploaded_file($this->tmp_path, $this->upload_directory . DS . $this->filename)) {
            if ($this->create()) {
                unset($tmp_path);
                return true;
            } else {
                $this->errors = "Something in moved_uploaded_file";
                return false;
            }
        }
    }
    public function delete_photo()
    {
        if ($this->delete()) {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();

            return unlink($target_path) ? true : false;
        } else {
            echo "If the photo isn't delete this function doesn't return nothing";
        }
    }
}
