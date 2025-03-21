<?php
// Déterminer sur quelle page on se trouve
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) htmlspecialchars(strip_tags($_GET['page']));
} else {
    $currentPage = 1;
}

require_once "connexion.php";

// Déterminer le nombre total d'articles
$sql = "SELECT COUNT(*) AS  nb_articles FROM `articles`";
$query = $db->prepare($sql);
$query->execute();
$totalArticles = $query->fetch()['nb_articles'];

// Calculer le nombre d'articles par page
$parPage = 10;

// Calculer le nombre de pages arrondi par excès
$pages = ceil($totalArticles / $parPage);

// Calculer le premier article à afficher
$premier = ($currentPage * $parPage) - $parPage;

// Requête pour récupérer les articles
$sql = "SELECT * FROM `articles` ORDER BY `created_at` DESC LIMIT :premier, :parPage";
$query = $db->prepare($sql);
$query->bindValue(':premier', $premier, PDO::PARAM_INT);
$query->bindValue(':parPage', $parPage, PDO::PARAM_INT);
$query->execute();
$articles = $query->fetchAll(PDO::FETCH_ASSOC);

require_once "close.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagination article</title>
    <style>
        .disabled {
            pointer-events: none;
            color: gray;
            opacity: 0.6;
        }

        .active {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <main class="container">
        <div class="row">
            <section>
                <h1>Liste des articles</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Titre</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articles as $article) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($article["id"]); ?></td>
                                <td><?php echo htmlspecialchars($article["title"]); ?></td>
                                <td><?php echo htmlspecialchars($article["created_at"]); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <nav>
                    <ul>
                        <!-- Lien vers la page précédente -->
                        <li class="<?php echo $currentPage === 1 ? 'disabled' : ''; ?>">
                            <a href="./?page=<?php echo $currentPage - 1; ?>">Page précédente</a>
                        </li>

                        <!-- Liens vers les pages -->
                        <?php for ($page = 1; $page <= $pages; $page++) { ?>
                            <li class="<?php echo $currentPage === $page ? 'active' : ''; ?>">
                                <a href="./?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                            </li>
                        <?php } ?>

                        <!-- Lien vers la page suivante -->
                        <li class="<?php echo $currentPage === $pages ? 'disabled' : ''; ?>">
                            <a href="./?page=<?php echo $currentPage + 1; ?>">Page suivante</a>
                        </li>
                    </ul>
                </nav>
            </section>
        </div>
    </main>
</body>

</html>