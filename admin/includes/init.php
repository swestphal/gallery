<?php
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', '/Users/simonewestphal/development/udemy/gallery');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH',SITE_ROOT.'admin/includes');

require_once("functions.php");
require_once("config.php");
require_once("class.database.php");
require_once("class.db_object.php");
require_once("class.session.php");
require_once("class.user.php");
require_once("class.photo.php");
require_once("class.comment.php");
require_once("class.pagination.php");
