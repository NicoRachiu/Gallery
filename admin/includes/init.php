<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', 'xampp' . DS . 'htdocs' . DS . 'gallery' . DS . 'admin');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'includes');

include("function.php");
include("new_config.php");
<<<<<<< HEAD
include("Database.php");
include("Session.php");
include("Db_Object.php");
include("Comment.php");
include("Photos.php");
=======
include("database.php");
include("session.php");
include("DB_Object.php");
include("comment.php");
include("photos.php");
>>>>>>> a84eea1600003a26307bdf372052d2efeaf47fb2
