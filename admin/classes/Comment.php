<?php

namespace Admin\Classes;

class Comment extends DB_Object
{
    protected static $db_table = "comments";
    protected static $db_table_fields = ['photo_id', 'author', 'id', 'body', 'created',];
    public $id;
    public $photo_id;
    public $created;
    public $author;
    public $body;
    public $comments;

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

    public static function find_all_comments_by_id($id)
    {
        global $database;
        $the_result_array = self::find_this_query("SELECT * FROM comments WHERE id = $id LIMIT 1");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;
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
