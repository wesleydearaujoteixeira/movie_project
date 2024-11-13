<?php

require_once("./templates/header.php");
require_once("./dao/userDAO.php");
require_once("./dao/movieDAO.php");  // Inclua o arquivo DAO de filmes, se necessário

$userDAO = new UserDAO($conn, $BASE_URL);
$userData = $userDAO->verifyToken(true);

// Criar uma instância de MovieDAO para buscar os filmes
$movieDAO = new MovieDAO($conn, $BASE_URL);
$movies = $movieDAO->getLatestMovies($userData['id']);  // Exemplo: Pegando filmes do usuário autenticado

?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Dashboard</h2>
    <p class="section-description">Adicione ou atualize as informações dos filmes que você enviou</p>

    <div class="col-md-12" id="add-movie-container">
        <a href="newmovie.php" id="card-btn">
            <i class="fas fa-plus"></i> Adicionar Filmes
        </a>
    </div>

    <div class="col-md-12" id="movies-dashboard">

        <table class="table">
            <thead>
                <th scope="col"> Título </th>
                <th scope="col"> Nota </th>
                <th scope="col" class="actions"> Ações </th>
            </thead>

            <tbody>
                <?php
                // Exibe os filmes dinamicamente
                if (count($movies) > 0) {
                    foreach ($movies as $movie) {
                        echo "<tr>";
                        echo "<td><a href='#' class='table-movie-title'  >" . htmlspecialchars($movie['title']) . "</a></td>";  // Título do filme
                        echo "<td><i class='fas fa-star'></i> " . 9 . "</td>";  // Nota do filme
                        echo "<td class='action-column'>";
                        echo "<a href='editmovie.php?id=" . $movie['id'] . "' class='edit-btn'>";
                        echo "<i class='far fa-edit'></i> Editar</a>";
                        echo "<form action='deletemovie.php' method='post' style='display:inline;'>";
                        echo "<input type='hidden' name='movie_id' value='" . $movie['id'] . "'>";
                        echo "<button type='submit' class='delete-btn'><i class='fas fa-times'></i> Excluir</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum filme encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>

    </div>

</div>

<?php
require_once("./templates/footer.php");
?>
