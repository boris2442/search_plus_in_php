<?php
$search = $_GET['search'] ?? '';
$valider = $_GET['valider'] ?? '';
if (isset($valider) && !empty(trim($search))) {
    include "./connexion.php";
    $words = explode(" ", trim($search));
    $conditions = [];//stocker le conditions sql
    $params = [];//Pour stocker les valeurs à utiliser dans les conditions
    foreach ($words as $word) {
        $conditions[] = "desg LIKE ?";
        $params[] = '%' . $word . '%';
    }
    $sql = "SELECT * FROM `avis2` WHERE " . implode(" OR ", $conditions);
    $requete = $db->prepare($sql);
    $requete->execute($params);
    $resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
    $afficher = "yes";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Search</title>
</head>

<body>
    <form action="" method="get">
        <input type="text" name="search" id="" placeholder="Effectuer une recherche" value="<?php echo htmlspecialchars($search); ?>">
        <input type="submit" value="Valider" name="valider">
    </form>
    <?php if (isset($afficher) && $afficher === "yes") { ?>
        <div id="result">
            <div class="nbr">
                <?php echo count($resultats) . " " . (count($resultats) > 1 ? "résultats" : "résultat"); ?>
            </div>
            <ol>
                <?php foreach ($resultats as $resultat) { ?>
                    <li><?php echo htmlspecialchars($resultat["desg"]); ?></li>
                <?php } ?>
            </ol>
        </div>
    <?php } ?>
</body>

</html>