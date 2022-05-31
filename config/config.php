<?php
/** URLs */
define('HOME',true);
$port = (HOME) ? '8080' : '8082';
define('URL','http://localhost:' . $port . '/mvc-php/');
define('VIEWS_DIR',URL . 'views');
define('MODS_DIR',URL . 'models');
define('CTRLS_DIR',URL . 'controllers');

/** CONEXION */
define('DB','expense-app');
define('HOST','localhost');
define('USER','root');
define('PASSWORD','');
define('CHARSET','utf8mb4');
