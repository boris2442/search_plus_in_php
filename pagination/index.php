<?php
//determiner sur quelle page on se trouve
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int)  htmlspecialchars(strip_tags($_GET['page']));
} else {
    $currentPage = 1;
}


require_once "connexion.php";

//determiner le nombre d'article totale

$sql = "SELECT COUNT(*) as nb_articles FROM `articles`";
$query = $db->prepare($sql);
$query->execute();

$totalArticles = $query->fetch()['nb_articles'];

//calculer le nombre d'articles par page
$parPage = 10;

//calculer le nombre de pages arrondi par exces
$pages = ceil($totalArticles / $parPage);

//calculer le premier article à afficher
$premier = ($currentPage * $parPage) - $parPage;

//requête pour récupérer les articles
$sql = "SELECT*FROM `articles` ORDER BY `created_at` DESC LIMIT $premier, $parPage";
$query = $db->prepare($sql);
$query->execute();

$articles = $query->fetchAll(PDO::FETCH_ASSOC);

require_once "close.php";

$sql = "SELECT*FROM `articles` ORDER BY `created_at` DESC";
$query = $db->prepare($sql);
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
</head>

<body>
    <main class="container">
        <div class="row">
            <section>
                <h1>listes des articles</h1>
                <table>
                    <thead>
                        <th>Id</th>
                        <th>Titre </th>
                        <th>Date</th>
                    </thead>
                    <tbody>
                        <?php foreach ($articles as $article) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($article["title"]); ?></td>
                                <td><?php echo htmlspecialchars($article["content"]); ?></td>
                                <td><?php echo htmlspecialchars($article["created_at"]); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <nav>
                    <ul>
                        <li <?php echo $currentPage === 1 ? 'class="disabled"' : ''; ?>>
                            <a href="./?page=<?= $currentPage - 1 ?>">Page precedente</a>
                        </li>
                        <?php for ($page = 0; $page < $pages; $page++):  ?>
                            <li class="echo ($currentPage===$page)? 'active' :  ' '      ?>">
                                <a href="./?page=<? $page ?>"><?php echo $page ?></a>
                            </li>
                        <?php endfor; ?>
                        <li>
                            <a href="./?page=<? $currentPage + 1 ?>">Page suivante</a>
                        </li>
                        <li <?php echo $currentPage === $pages ? 'class="disabled"' : ''; ?>>
                            <a href="">2</a>
                        </li>
                    </ul>
                </nav>
            </section>
        </div>
    </main>
</body>

</html>