<?php require_once("includes/init.php");

if (!$session->is_signed_in()) {
    redirect_to("login.php");
}

if (empty($_GET['id'])) {
    redirect_to("comments.php");
}

$comment = Comment::find_by_id($_GET['id']);

if ($comment) {
    $comment->delete();
    if (!isset($_GET['photo_id'])) {
        redirect_to("comments.php");
    } else {
        redirect_to("comments_photo.php?id=".$comment->photo_id);
    }
} else {
    redirect_to('comments.php');
}