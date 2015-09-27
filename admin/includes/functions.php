<?php
function __autoload($class) {
    $class = strtolower($class);
    $path = "includes/class.{$class}.php";
    if(file_exists($path)) {
        require_once($path);

    }
    else {
    die("This file named class.{$class}.php was not found.");
    }
}

function redirect_to($location) {
    header('Location: '. $location);
exit;
}