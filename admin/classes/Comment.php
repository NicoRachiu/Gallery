<?php

namespace Admin\Classes;

class Comment extends DB_Object
{
    protected static $db_table = "comments";
    protected static $db_table_fields = ['photo_id', 'author', 'id', 'body',];
    public $id;
    public $photo_id;
    public $author;
    public $body;

    public static function create_comment($photo_id, $author, $body)
    {
        if (!empty($photo_id) && !empty($author) && !empty($body)) {
            $comment = new self();
            $comment->photo_id = (int)$photo_id;
            $comment->author = $author;
            $comment->body = $body;

            return $comment;
        } else {
            echo "Something of Message is empty.";
        }
    }

    public static function find_the_comments($photo_id = 0)
    {
        global $database;
        $sql = "SELECT * FROM " . self::$db_table;
        $sql .= " WHERE photo_id =" . $database->escape_string($photo_id);
        $sql .= " ORDER BY photo_id ASC";
        return self::find_this_query($sql);
    }
}
