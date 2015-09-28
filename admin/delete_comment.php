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
    redirect_to("comments.php");
} else {
    redirect_to('comments.php');
}