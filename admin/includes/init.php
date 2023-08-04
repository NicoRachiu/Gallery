<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', 'xampp' . DS . 'htdocs' . DS . 'gallery' . DS . 'admin');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'includes');

include("function.php");
include("new_config.php");
include("Database.php");
include("Session.php");
include("Db_Object.php");
include("Comment.php");
include("Photos.php");
