<?php

@$search=$_GET['search'];
@$valider=$_GET['valider'];
if(isset($valider) && !empty(trim($search))){
    include "./connexion.php";
    $sql="SELECT desg * FROM `avis2` WHERE desg like?";
    $requete=$db->prepare($sql);


}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search</title>
</head>

<body>
    <form action="" method="get">
        <input type="text" name="search" id="" placeholder="effectuer une recherche">
        <input type="submit" value="Valider" name="Valider">
    </form>
    <div id="result">
        <div class="nbr">
            2 messages trouves
        </div>
        <ol>
            <li>Resultat1</li>
        </ol>
    </div>

</body>

</html>