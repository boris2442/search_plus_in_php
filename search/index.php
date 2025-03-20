<?php

@$search = $_GET['search'];
@$valider = $_GET['valider'];
if (isset($valider) && !empty(trim($search))) {
    include "./connexion.php";
    // $sql="SELECT desg * FROM `avis2` WHERE desg like?";
    $sql = "SELECT * FROM `avis2` WHERE desg LIKE ?";
    $requete = $db->prepare($sql);
    $requete->execute(['%' . $search . '%']);
    $resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
    $affcher = "yes";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>search</title>
</head>

<body>
    <form action="" method="get">
        <input type="text" name="search" id="" placeholder="effectuer une recherche" value="<?php echo $search ?>">
        <input type="submit" value="Valider" name="Valider">
    </form>
    <?php if (@$afficher === "yes") { ?>
        <div id="result">
            <div class="nbr">
                <?php echo count($tab) . "" . (count($tab) > 1 ? "resultats" : "resultat") ?>
            </div>
            <ol>
                <?php for ($i = 0; $i < count($tab); $i++) { ?>
                    <li><?php echo $tab[$i]["desg"] ?></li>
            </ol>
        <?php } ?>
        </div>
    <?php } ?>
</body>

</html>