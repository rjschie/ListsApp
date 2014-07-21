<?php


if($_SERVER['HTTP_HOST'] == 'ryanschie.com') {
	define('DB_HOST', 'internal-db.s192738.gridserver.com');
	define('DB_NAME', 'db192738_app_listsapp');
	define('DB_USER', 'db192738');
	define('DB_PASS', '0ziQf8n6$@#62d');
} else {
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'app_listsapp');
	define('DB_USER', 'root');
	define('DB_PASS', 'rschie');
}
