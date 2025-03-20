<?php
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "checkbox");

// 'Gill Sans', 'Gill Sans MT',
//'Playwrite Italia Moderna', Consolas, 'Courier New', monospace
$dsn = "mysql:dbname=" . DBNAME . "; host=" . DBHOST;
try {
    $db = new PDO($dsn, DBUSER, DBPASS);
    $db->exec("SET NAMES utf8");
   
} catch (PDOException $e) {
    die($e->getMessage());
  
}
