<?php


class Comment extends Db_object
{

    protected static $db_table = "comments";
    protected static $db_table_fields = array('photo_id', 'author', 'body');
    public $id;
    public $photo_id;
    public $author;
    public $body;

//    public static function create_comment($photo_id, $author = "John", $body = "huhu")
//    {
//        if (!empty($photo_id) && !empty($author) && !empty($body)) {
//
//            $comment = new Comment();
//            $comment->photo_id = $photo_id;
//            $comment->author = $author;
//            $comment->body = $body;
//            return $comment;
//        } else {
//            return false;
//        }
//    }

    public static function find_the_comments($photo_id) {
        $query  = "SELECT * FROM comments ".self::$db_table;
        $query .= " WHERE photo_id = " . $photo_id;
        $query .= " ORDER BY photo_id ASC";

        return self::find_this_query($query);
    }

}