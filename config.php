<?php

define('DSN', 'mysql:host=localhost;dbname=blog;charset=utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', 'daich1');

define('SITE_URL', 'http://#/contacts_php/');
define('ADMIN_URL', SITE_URL.'admin/');


error_reporting(E_ALL & ~E_NOTICE);

session_set_cookie_params(0, '/contacts_php/');

?>