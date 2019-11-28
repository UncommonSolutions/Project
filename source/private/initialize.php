<?php

ob_start(); // turn on output buffering

// Assign file paths to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
define("PRIVATE_PATH", dirname(__FILE__));
define("SOURCE_PATH", dirname(PRIVATE_PATH));
//define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

$source_end = strpos($_SERVER['SCRIPT_NAME'], '/source') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $source_end);
define("WWW_ROOT", $doc_root);

require_once('database_functions.php');
require_once('functions.php');
require_once ('api/UserLoginTableApi.php');


$database = db_connect();
