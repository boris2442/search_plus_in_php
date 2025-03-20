<?php
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "pagination");
$dsn="mysql:dbname=".DBNAME.";host=".DBHOST;
try{
    $db=new PDO($dsn,DBUSER,DBPASS);
    $db->exec("SET NAMES utf8");
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie";

}catch(PDOException $e){
    die($e->getMessage());
}
?>