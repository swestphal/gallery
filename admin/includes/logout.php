<?php
require_once("header.php");
$session->logout();
redirect_to("../login.php");
