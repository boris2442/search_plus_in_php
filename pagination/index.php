<?php
require_once "connexion.php";
$sql="SELECT*FROM `articles` ORDER BY `created_at` DESC";
$query=$db->prepare($sql);
$query->execute();
$articles=$query->fetchAll(PDO::FETCH_ASSOC);

?>