<?php require_once("includes/init.php");

if (!$session->is_signed_in()) {
    redirect_to("login.php");
}

if (empty($_GET['id'])) {
    redirect_to("users.php");
}

$user = User::find_by_id($_GET['id']);

if ($user) {
    $user->delete_user();
    redirect_to("users.php");
} else {
    redirect_to('users.php');
}